<div class="d-flex flex-column align-items-center">
    <div class="size_box_100"></div>
    <div class="w100p_mw614">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column justify-content-center">
                <div class="circleimg h150 w150 pointer feedwin">
                    <img src='/static/img/profile/<?= $this->data->iuser ?>/<?= $this->_DATA->mainimg ?>' onerror='this.error=null;this.src="/static/img/profile/defaultProfileImg_100.png"'>
                </div>
            </div>

            <div></div>
        </div>
    </div>
</div>

<!-- 프로필 사진 바꾸기 -->
<div class="modal fade" id="changeProfileImgModal" tabindex="-1" aria-labelledby="changeProfileImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-x1">

    </div>
</div>