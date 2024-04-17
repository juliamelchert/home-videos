<?php
    require_once('../../KLogger.php');

    class Dao {

        protected $logger;
        private $host;
        private $db;
        private $user;
        private $pass;

        public function __construct () {
            $this->logger = new KLogger("../../log.txt", KLogger::DEBUG);

            // For local setup:
            // $env = parse_ini_file('../../.env');
            // $this->host = $env["DB_HOST"];
            // $this->db = $env["DB_NAME"];
            // $this->user = $env["DB_USER"];
            // $this->pass = $env["DB_PASS"];

            date_default_timezone_set('America/Boise');
        }

        /*
         * GETTERS
        */

        public function getConnection () {
            // Copied from Heroku documentation: https://devcenter.heroku.com/articles/connecting-heroku-postgres#connecting-with-pdo
            $db = parse_url(getenv("DATABASE_URL"));

            $pdo = new PDO("pgsql:" . sprintf(
                "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
            ));
            return $pdo;

            // For local use:
            // return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
        }

        public function checkTitleIsUnique($title) {
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT * FROM Videos WHERE title = ?");
            $query->execute([$title]);

            $result = $query->fetchAll();
            if (count($result) == 0) {
                return true;
            } else {
                return false;
            }
        }

        private function getVideoIdFromTitle($title) {
            $this->logger->LogDebug("getVideoIdFromTitle: Getting video_id for " . $title);

            // Get the video_id of the video
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT video_id FROM Videos WHERE title = ? LIMIT 1");
            $query->execute([$title]);

            return $query->fetch()['video_id'];
        }

        private function getTagIdFromName($name) {
            $this->logger->LogDebug("getTagIdFromName: Getting tag_id for " . $name);

            // Get the tag_id of the video
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT tag_id FROM Tags WHERE name = ? LIMIT 1");
            $query->execute([$name]);

            return $query->fetch()['tag_id'];
        }

        public function checkLogin($username, $password) {
            $salt = "juliaiscool12039mfcjnq02m9eurce0fmqs9j2198fvn1vu30m9xs34";
            $hashedPass = hash('sha256', $password . $salt);

            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT * FROM Users WHERE username = ? and password = ?");
            $query->execute([$username, $hashedPass]);

            $result = $query->fetchAll();
            if (count($result) == 0) {
                return false;
            } else {
                return true;
            }
        }

        public function checkAdmin($username) {
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT admin FROM Users WHERE username = ?");
            $query->execute([$username]);

            $result = $query->fetch()['admin'];
            if ($result == 1) {
                return true;
            } else {
                return false;
            }
        }

        public function getVideos() {
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT * FROM Videos ORDER BY date_uploaded DESC");
            $query->execute();

            $result = $query->fetchAll();
            return $result;
        }

        public function getRecentVideos() {
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT * FROM Videos ORDER BY date_uploaded DESC LIMIT 3");
            $query->execute();

            $result = $query->fetchAll();
            return $result;
        }

        public function searchForStr($str) {
            $conn = $this->getConnection();

            $query = $conn->prepare("SELECT DISTINCT v.title, v.youtube_link, COALESCE(t.name, 'No Tag') AS tag_name
                                     FROM Videos v
                                     LEFT JOIN Videos_Tags vt ON v.video_id = vt.video_id
                                     LEFT JOIN Tags t ON vt.tag_id = t.tag_id
                                     WHERE LOWER(v.title) LIKE '%' || LOWER(?) || '%'
                                        OR LOWER(v.youtube_link) LIKE '%' || LOWER(?) || '%'
                                        OR LOWER(t.name) LIKE '%' || LOWER(?) || '%';");
            $query->execute([$str, $str, $str]);

            $result = $query->fetchAll();
            return $result;
        }

        /*
         * CREATE
        */

        public function createVideosTags($title, $tags) {
            $conn = $this->getConnection();
            $addTagQuery = "INSERT INTO Videos_Tags (video_id, tag_id) VALUES (?, ?)";
            $video_id = $this->getVideoIdFromTitle($title);

            $this->logger->LogDebug("createVideosTags: About to add tags for video titled " . $title . " and tags " . print_r($tags, 1));

            // For each tag, add a new row to the Videos_Tags table to indicate a connection
            foreach ($tags as $tag) {
                $tag_id = $this->getTagIdFromName($tag);
                $this->logger->LogDebug("createVideosTags: Adding Video_Tags entry for video_id " . print_r($video_id, 1) . ", tag_id " . print_r($tag_id, 1));
                
                // Make sure the video_id and tag_id exist before attempting to insert
                if (strlen($video_id) > 0 and strlen($tag_id) > 0) {
                    $conn->prepare($addTagQuery)->execute([$video_id, $tag_id]);
                }
            }
        }

        public function createVideo($title, $url, $date, $tags) {
            $this->logger->LogInfo("createVideo: creating video [{$title}], [{$url}], [{$date}], [" . print_r($tags, 1) . "]");
            $conn = $this->getConnection();
            $createQuery = "INSERT INTO Videos (title, youtube_link, date_created, date_uploaded) VALUES (?, ?, ?, ?)";
            $q = $conn->prepare($createQuery);
            $q->execute([$title, $url, $date, date("Y-m-d")]);

            // Create tag connections for the new video
            $this->createVideosTags($title, $tags);
        }

        /*
         * UPDATE
        */


        /*
         * DELETE
        */
        public function deleteVideoFromTitle($title) {
            $conn = $this->getConnection();

            $query = "DELETE FROM Videos WHERE title = ?";
            $q = $conn->prepare($query);
            $q->execute([$title]);
            $this->logger->LogInfo("deleteVideoFromTitle: deleted video with title: " . $title);
        }
    }
?>