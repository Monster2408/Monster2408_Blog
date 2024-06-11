window.addEventListener('load',function(){
    function reqListener() {
        function getCardHtml(title, image, dateStr, link) {
            var html_text = '<div class="l-wrapper">';
            html_text += '<article class="card">';
            html_text += '<div class="card__header">';
            html_text += '<h3 class="card__title">' + title + '</h3>';
            html_text += '<figure class="card__thumbnail">';
            html_text += '<img src="' + image + '" class="card__image">';
            html_text += '</figure>';
            html_text += '</div>';
            html_text += '<div class="card__body">';
            html_text += '<p class="card__text">投稿日：' + dateStr + '</p>';
            html_text += '</div>';
            html_text += '<div class="card__footer">';
            html_text += '<p class="card__text"><a href="' + link + '" class="button -compact">' + title + 'の詳細を見る</a></p>';
            html_text += '</div>';
            html_text += '</article>';
            html_text += '</div>';
            return html_text;
        }
        var domDoc = this.responseXML;
        console.log(domDoc);
        var items = domDoc.getElementsByTagName("item");
        var recommendArea = document.getElementById("recommend-area");
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
            var categories_temp = item.getElementsByTagName("category");
            var categories = [];
            // categoryは<![CDATA[カテゴリ名]]>という形式で格納されている
            for (var j = 0; j < categories_temp.length; j++) {
                var category = categories_temp[j].textContent;
                category = category.replace(/<!\[CDATA\[/, "");
                category = category.replace(/\]\]>/, "");
                categories.push(category);
            }
            if (categories.indexOf("おすすめ") == -1) {
                continue;
            }
            // descriptionにimgタグがあるかどうかを判定
            var image = "https://monster2408.com/blog/wp-content/themes/cocoon-master/images/no-image-320.png";
            if (description.match(/<img[^>]+src="([^">]+)"/) != null) {
                image = description.match(/<img[^>]+src="([^">]+)"/)[1];
            }
            if (location.href.match(/localhost/)) {
                data_text += getCardHtml(title, image, dateStr, "https://localhost/?p=" + link_id);
            } else {
                data_text += getCardHtml(title, image, dateStr, "https://monster2408.com/featured-products/?p=" + link_id);
            }
        }
        recommendArea.innerHTML = data_text;
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
})