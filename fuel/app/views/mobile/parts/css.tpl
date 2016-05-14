{Asset::css('mobile/pure.css')}
{Asset::css('mobile/side-menu.css')}
{Asset::css('mobile/component.css')}
{* iOSとandroidでCSSを振り分け *}
{if strpos(Agent::platform(), "iOS") !== false || strpos(Agent::platform(), "MacOSX") !== false}
{Asset::css('mobile/recomatch.css')}
{else}
{Asset::css('mobile/recomatch_android.css')}
{/if}
{Asset::render('add_css')}
