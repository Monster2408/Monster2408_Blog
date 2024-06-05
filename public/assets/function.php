<?php


/**
 * MyFunction
 */
class MyFunction {

    public $wiki_version = "v1.0.0";
    
    public $conf_path;
    public $assets_path;
    public $pageUrl;
    public $description;
    public $pdo;
    public $thumbnail;

    public $id;
    public $title;
    public $content;
    public $created_at;
    public $updated_at;
    public $tags;

    public $author_id;

    public $user;
    public $user_id;
    public $user_name;
    public $user_icon;

    public $disLib;

    public $edit_bool;
    public $no_template;

    public $og_type;
    public $og_url;
    public $og_title;
    public $og_description;
    public $og_site_name;
    public $og_image;

        /**
     * __construct
     *
     * @param  mixed $conf_path 設定ファイルのパス
     * @param  mixed $page_id ページID
     * @return void
     */
    public function __construct($conf_path = "./assets/config.php", $page_id=-99) {
        $this->conf_path = $conf_path;
        $this->assets_path = str_replace("/assets/config.php", "", $conf_path);

        $this->pageUrl = $this->getUrl().'/';
        $this->description = "MonsterLifeServerの非公式Wiki";

        include($conf_path);
        require_once($this->assets_path.'/assets/lib/discord-lib.php');
        $this->disLib = new DiscordLib($conf["discord"]["oauth2_redirect"], $conf["discord"]["oauth2_id"], $conf["discord"]["oauth2_secret"]);
        
        $this->disLib->initDiscordOAuth();

        // 閲覧者の情報を取得
        $this->user_id = -1;
        $this->user_icon = null;
        $this->user_name = "Guest";
        if ($this->disLib->isLogin()) {
            $user = $this->disLib->apiRequest($this->disLib->apiURLBase);
            if (property_exists($user, "id") === TRUE) {
                $this->user_id = $user->id;
                $this->user_icon = "https://cdn.discordapp.com/avatars/'. $user->id. '/'. $user->avatar .'.jpg";
                $this->user_name = $user->username;
            }
        }
        $this->user = [
            "id" => $this->user_id,
            "icon" => $this->user_icon,
            "name" => $this->user_name,
        ];

        $dsn = 'mysql:dbname='.$this->getSqlDataBase().';host='.$this->getSqlHost().';charset=utf8mb4';
        $this->pdo = new PDO($dsn,$this->getSqlUser(),$this->getSqlPassWord());
        $title = "MonsterLifeServer 非公式WIKI";
        $content = "";
        if ($page_id == -99) $page_id = $this->getPrivateId();
        $author_id = -1;
        $created_at = "0000年00月00日(日) 00:00:00";
        $updated_at = "0000年00月00日(日) 00:00:00";
        $tags = "";
        if ($page_id != -1) {
            try {
                // idを元に記事を取得する
                $sql = "SELECT * FROM `posts` WHERE `id` = ".$page_id.";";
    
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result != false) {
                    $id = $result["id"];
                    $title = $result["title"];
                    $content = $result["content"];
                    $author_id = $result["user_id"];
                    $created_at = $result["created_at"];
                    $updated_at = $result["updated_at"];
                    $tags = $result["tags"];
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        $this->title = $title;
        $this->id = $page_id;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->tags = $tags;
        $this->thumbnail = "https://monster2408.com/blog/";

        // 編集できるかどうか
        $this->edit_bool = true;
        $this->is_patch = false;
        $this->no_template = false;

        // OGP
        $this->og_title = $title;
        $this->og_description = $title;
        $this->og_site_name = "MonsterLifeServer 非公式WIKI";
        $this->og_image = "https://monster2408.com/blog/";
        if ($page_id != -1) {
            $this->og_type = "article";
            $this->og_url = "https://monster2408.com/blog/?p=" . $page_id;
        } else {
            $this->og_type = "website";
            $this->og_url = "https://monster2408.com/blog/";
        }
    }
}