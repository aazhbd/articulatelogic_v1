<div class="topmenu" style="width: 98%;">
    <div style="float: left; width: 58%;">
        <a href="{$smarty.const.URL}/uhome" {if $selMenu == "home" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/home.png" alt="Users" style="width: 20px;  border:none;"/>
            Home
        </a>
        
        <a href="{$smarty.const.URL}/manage/users" {if $selMenu == "user" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/users.png" alt="Users" style="width: 20px;  border:none;"/>
            User
        </a>        
        <a href="{$smarty.const.URL}/manage/categories" {if $selMenu == "category" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/category.png" alt="Article" style="width: 20px;  border:none;"/>
            Category
        </a>
        <a href="{$smarty.const.URL}/manage/articles" {if $selMenu == "article" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/article.png" alt="Category" style="width: 20px;  border:none;"/>
            Article
        </a>
        <a href="{$smarty.const.URL}/manage/images" {if $selMenu == "images" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/image.png" alt="Files" style="width: 20px;  border:none;"/>
            Article Images
        </a>
        <a href="{$smarty.const.URL}/manage/files" {if $selMenu == "files" } id="selMenu"{/if}>
            <img src="{$smarty.const.URL}/interface/images/files.png" alt="Files" style="width: 20px;  border:none;"/>
            Files
        </a>
    </div>
    <div style="float: right; width: 38%;" align="right">
        <a href="{$smarty.const.URL}/edit/account" >
            <img src="{$smarty.const.URL}/interface/images/editacc.png" alt="Users" style="width: 20px; border:none; "/>
            Edit Account
        </a>
    </div>
</div>
