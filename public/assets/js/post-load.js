// urlのp=〇部分を取得するための正規表現
const url = window.location.href;
var post_id = url.split("?p=")[1];
window.addEventListener('load',function(){
    function reqListener() {
        var domDoc = this.responseXML;
        console.log(domDoc);
        var items = domDoc.getElementsByTagName("item");
        var title_area = document.getElementById("post-title");
        var contentArea = document.getElementById("content-area");
        var data_text = ""; 
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var title = item.getElementsByTagName("title")[0].textContent;
            var link = item.getElementsByTagName("guid")[0].textContent;
            // link から記事IDを取得
            var link_id = link.split("?p=")[1];
            var pubDate = item.getElementsByTagName("pubDate")[0].textContent;
            var date = new Date(pubDate);
            var dateStr = date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate();
            var description = item.getElementsByTagName("content:encoded")[0].textContent;
            // descriptionにimgタグがあるかどうかを判定
            var image = "https://monster2408.com/blog/wp-content/themes/cocoon-master/images/no-image-320.png";
            if (description.match(/<img[^>]+src="([^">]+)"/) != null) {
                image = description.match(/<img[^>]+src="([^">]+)"/)[1];
            }
            if (link_id != post_id) {
                continue;
            } else {
                console.log("post_id: " + post_id);
                console.log("link_id: " + link_id);
                title_area.innerHTML = title;
                contentArea.innerHTML = description;
            }
        }
    }
    const req = new XMLHttpRequest();
    req.addEventListener("load", reqListener);
    var url = "https://monster2408.com/blog/feed/";
    // 現在URLがlocalhostの場合はローカルのXMLを読み込む
    if (location.href.match(/localhost/)) {
        url = "./test.xml";
    }
    req.open("GET", url);
    req.setRequestHeader("Content-Type", "text/xml");
    req.send();
});