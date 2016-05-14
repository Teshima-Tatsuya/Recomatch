<!-- モーダルの表示(テスト) -->
<div class="modal fade" id="myreco_movieModal_{Model_Movie::getMovieId($myreco->movie_id)}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Movie</h4>
            </div>
            <div class="modal-body" align="center">
                <iframe width="640" height="360" src="http://www.youtube.com/embed/{Model_Movie::getMovieId($myreco->movie_id)}" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
