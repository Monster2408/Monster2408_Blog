<div class="navigation-area">
    <div class="tool-object">
        <!-- input (type:text)の入力欄と挿入というボタンのあるポップアップウインドウを作成 -->
        <div id="image_form" class="tool_form">
            <div class="tool_form_inner image_form_inner">
                <button type="button" id="image-close-btn" class="tool-form-close-btn" onclick="toggle_image_form()"><i class="fa-solid fa-xmark"></i></button>

                <input type="text" id="input_image_uri" placeholder="ここに画像のURLを入力">
                <input type="text" id="input_image_height" placeholder="高さ">
                <input type="text" id="input_image_width" placeholder="横幅">
                <input type="text" id="input_image_alt" placeholder="説明">

                <button type="button" id="add_image_btn" class="set-tool-form-btn" onclick="add_image()">挿入</button>
            </div>
            <div class="form-black-background" id="image-black-bg" onclick="toggle_image_form()"></div>
        </div>
        <div id="color_form" class="tool_form">
            <div class="tool_form_inner color_form_inner">
                <button type="button" id="color-close-btn" class="tool-form-close-btn" onclick="toggle_color_form()"><i class="fa-solid fa-xmark"></i></button>

                <input type="color" id="input_color_font">
                <input type="color" id="input_color_bg">

                <button type="button" id="add_image_btn" class="set-tool-form-btn" onclick="set_color()">設定</button>
            </div>
            <div class="form-black-background" id="color-black-bg" onclick="toggle_color_form()"></div>
        </div>
    </div>
    <div class="preview-toggle-panel">
        <button type="button" onclick="markdown_preview_update()">プレビュー</button>
    </div>
    <div id="wiki-tool-box" class="wiki-tool-box active">
        <button type="button" class="wiki-tool-button wiki-headline-button" data-items="headline" title="見出し" onclick="headline_toggle()">
            見出し
            <i class="fa fa-chevron-down"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-insert-button" data-items="bold" title="太字" onclick="bold()">
            <i class="fa fa-bold"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-line-through" data-items="line_through" title="取消し線" onclick="line_through()">
            <i class="fa-solid fa-strikethrough"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-italic" data-items="italic" title="斜体" onclick="italic()">
            <i class="fa-solid fa-italic"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-add-img" data-items="image" title="画像" onclick="toggle_image_form()">
            <i class="fa-solid fa-image"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-color" style="display: none;" data-items="color" title="色" onclick="toggle_color_form()">
            <i class="fa-solid fa-palette"></i>
        </button>
        <button type="button" class="wiki-tool-button wiki-toc-button" data-items="toc" title="目次" onclick="add_toc()">
            <i class="fa-solid fa-list"></i>
        </button>
    </div>
    <ul id="wiki-headline-items">
        <li>
            <a class="wiki-insert-button" id="headline-4" onclick="headline4()">
                小見出し(h4)
            </a>
        </li>
        <li>
            <a class="wiki-insert-button" id="headline-3" onclick="headline3()">
                中見出し(h3)
            </a>
        </li>
        <li>
            <a class="wiki-insert-button" id="headline-2" onclick="headline2()">
                大見出し(h2)
            </a>
        </li>
    </ul>
</div> 