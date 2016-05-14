<script id="sidemenu.html" type="text/ng-template">
<ion-side-menus>
    <ion-side-menu-content>
        <ion-nav-bar class="bar-positivebar-light">
            <ion-nav-back-button class="button-icon ion-arrow-left-c">
            </ion-nav-back-button>
        </ion-nav-bar>
        <ion-nav-buttons side="left">
            <button class="button button-icon button-clear ion-navicon" ng-click="toggleLeft()">
            </button>
        </ion-nav-buttons>
        <ion-nav-buttons side="right">
            <div class="buttons">
              <button class="button button-icon ion-compose" ng-click="modal.show()">
              </button>
            </div>
        </ion-nav-buttons>
        <ion-nav-view name="menuContent"></ion-nav-view>
    </ion-side-menu-content> 

    <ion-side-menu side="left">
        <ion-header-bar class="bar-assertive">
            <h1 class="title">Left Menu</h1>
        </ion-header-bar>
        <ion-content>
            <ul class="list">
                <a href="#" ng-click="pageLink('/myreco/index')" class="item" menu-close>新着</a>
                <a href="#" ng-click="pageLink('/mypage/list')" class="item" menu-close>カテゴリー</a>
                <a href="#" ng-click="pageLink('/feed/myreco')" class="item" menu-close>{Asset::img("icon/newspaper-64.png", ['width' => 24,'style' => 'vertical-align:middle'])}フィード</a>
                <a href="#" ng-click="pageLink('/myreco/index')" class="item" menu-close>{Asset::img('icon/add-list-64.png',['width' => 24,'style' => 'vertical-align:middle'])}マイレコ</a>
                <a href="/mypage" class="item" menu-close>{Asset::img('icon/movie.png',['width' => 24,'style' => 'vertical-align:middle'])}ムービー</a>
                <a href="/mypage" class="item" menu-close>{Asset::img("icon/favorite.png", ['width' => 24,'style' => 'vertical-align:middle'])}お気に入り</a>
                <a href="/mypage" class="item" menu-close>{Asset::img("icon/user.png", ['width' => 24,'style' => 'vertical-align:middle'])}フォロー</a>
                <a href="/mypage" class="item" menu-close>{Asset::img("icon/user.png", ['width' => 24,'style' => 'vertical-align:middle'])}フォロワー</a>
                <a href="/mypage" class="item" menu-close>{Asset::img("icon/info.png", ['width' => 24,'style' => 'vertical-align:middle'])}お知らせ</a>

            </ul>
        </ion-content>
    </ion-side-menu>
</ion-side-menus>
</script>

<script id="modal.html" type="text/ng-template">
      <div class="modal" ng-controller="ModalCtrl">
        <ion-header-bar class="bar bar-header bar-positive">
          <h1 class="title">New Contact</h1>
          <button class="button button-clear button-primary" ng-click="modal.hide()">Cancel</button>
        </ion-header-bar>
        <ion-content>
          <div class="padding">
          <div class="list">
              <label class="item item-input">
                <input ng-model="newUser.title" placeholder="作品名を入力" type="text">
              </label>
              <div align="right">
              <button class="button" style="margin-top:10">
                画像を取得
              </button>
              </div>
          </div>
            <div align="center">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
                <img src="http://flinks-start.jp/images/cc/ad/200_ccadcd10f3b79d45df09b7adc9fa7e68.jpg" width="90">
            </div>
          <div class="list">
              <label class="item item-input">
                <span class="input-label">カテゴリー</span>
                <select style="display: block;width:100%; height: 40px; padding: 6px 12px; background-color: #ffffff; border: 1px solid #fff;">
                  <option value="0">必ず選択して下さい</option>
                    {foreach Model_Category::getAll() as $category}
                        <option value="{$category->id}">{$category->name}</option>
                    {/foreach}
                </select>
              </label>
          </div>
          <div class="list">
              <label class="item item-input">
                <span class="input-label">タグ</span>
                <input ng-model="newUser.title" placeholder="タグは,で区切ってください" type="text">
              </label>
          </div>
            <div class="list">
              <label class="item item-input">
                <input ng-model="newUser.email" placeholder="youtubeのURLを入力(任意)" type="text">
              </label> 
            </div>
            <div class="list">
              <label class="item item-input">
                <textarea rows="5" placeholder="コメントを入力"></textarea>
              </label>
            </div>
              <button class="button button-full button-positive" ng-click="createContact()">Create</button>
            </div>
          </div>
        </ion-content>
      </div>
    </script>