{$kind = ($contents instanceof Model_Myreco) ? 'myreco' : 'movie'}
{*ログイン済みで自分の投稿なら削除ボタン、自分でなければ好き、お気に入りボタン*}
{* ログイン判定 *}
{if Recomatch_Util::isLogin()}
{* 投稿者判定 *}
{if Recomatch_Util::isMine($contents->user_id)}
	<div align="center" style="margin-top:10px;">
		<form class="{$kind}_delete_form" action="/{$kind}/delete" method="POST" onsubmit="return false">
			<button class="pure-button delete-button" href="#"><span class="button-string">削除</span></button>
			<input type="hidden" name="{$kind}_id" value="{$contents->id}" />
		</form>
	</div>
{else}
	<div class="pure-g">
		<div class="pure-u-1-2 pure-u-md-2-4" align="right">
			{Recomatch_Util::getButton(Recomatch_Constants::BUTTON_GOOD, $contents, $me->id)}
		</div>
		<div class="pure-u-1-2 pure-u-md-2-4">
			{Recomatch_Util::getButton(Recomatch_Constants::BUTTON_FAVORITE, $contents, $me->id)}
		</div>
	</div>
{/if}{* 投稿者判定 *}
{/if}{* ログイン判定 *}
