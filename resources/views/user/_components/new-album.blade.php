<!-- Albums onboarding modal -->
        <!-- /partials/pages/feed/modals/albums-help-modal.html -->
        <div id="albums-help-modal" class="modal albums-help-modal is-xsmall has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Add Photos</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="content-block is-active">
                            <img src="/assets/img/illustrations/cards/albums.svg" alt="">
                            <div class="help-text">
                                <h3>Manage your photos</h3>
                                <p>Lorem ipsum sit dolor amet is a dummy text used by the typography industry and the web industry.</p>
                            </div>
                        </div>

                        <div class="content-block">
                            <img src="/assets/img/illustrations/cards/upload.svg" alt="">
                            <div class="help-text">
                                <h3>Upload your photos</h3>
                                <p>Lorem ipsum sit dolor amet is a dummy text used by the typography industry and the web industry.</p>
                            </div>
                        </div>

                        <div class="slide-dots">
                            <div class="dot is-active"></div>
                            <div class="dot"></div>
                        </div>
                        <div class="action">
                            <button type="button" class="button is-solid accent-button next-modal raised" data-modal="albums-modal">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Album upload modal -->
        <!-- /partials/pages/feed/modals/albums-modal.html -->
        <div id="albums-modal" class="modal albums-modal is-xxl has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>New album</h3>
                        <div class="button is-solid accent-button fileinput-button">
                            <i class="mdi mdi-plus"></i>
                            Add pictures/videos
                        </div>

                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="left-section">
                            <div class="album-form">
                                <div class="control">
                                    <input type="text" class="input is-sm no-radius is-fade" placeholder="Album name">
                                    <div class="icon">
                                        <i data-feather="camera"></i>
                                    </div>
                                </div>
                                <div class="control">
                                    <textarea class="textarea is-fade no-radius is-sm" rows="3" placeholder="describe your album ..."></textarea>
                                </div>
                                <div class="control">
                                    <input type="text" class="input is-sm no-radius is-fade" placeholder="Place">
                                    <div class="icon">
                                        <i data-feather="map-pin"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="album-date" class="album-date">
                                <div class="head">
                                    <h4>Change the date</h4>
                                    <button type="button" class="button is-solid dark-grey-button icon-button">
                                        <i data-feather="plus"></i>
                                    </button>
                                </div>

                                <p>Set a date for your album. You can always change it later.</p>
                                <div class="control is-hidden">
                                    <input id="album-datepicker" type="text" class="input is-sm is-fade" placeholder="Select a date">
                                    <div class="icon">
                                        <i data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="tagged-in-album" class="tagged-in-album">
                                <div class="head">
                                    <h4>Tag friends in this album</h4>
                                    <button type="button" class="button is-solid dark-grey-button icon-button">
                                        <i data-feather="plus"></i>
                                    </button>
                                </div>

                                <p>Tag friends in this album. Tagged friends can see photos they are tagged in.</p>
                                <div class="field is-autocomplete is-hidden">
                                    <div class="control">
                                        <input id="create-album-friends-autocpl" type="text" class="input is-sm is-fade" placeholder="Search for friends">
                                        <div class="icon">
                                            <i data-feather="search"></i>
                                        </div>
                                    </div>
                                </div>

                                <div id="album-tag-list" class="album-tag-list"></div>

                            </div>

                            <div class="shared-album">
                                <div class="head">
                                    <h4>Allow friends to add photos</h4>
                                    <div class="basic-checkbox">
                                        <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                                        <label for="styled-checkbox-1"></label>
                                    </div>
                                </div>

                                <p>Tagged friends will be able to share content inside this album.</p>
                            </div>

                        </div>
                        <div class="right-section has-slimscroll">

                            <div class="modal-uploader">
                                <div id="actions" class="columns is-multiline no-mb">
                                    <div class="column is-12">
                                        <span class="button has-icon is-solid grey-button fileinput-button">
                                                <i data-feather="plus"></i>
                                            </span>
                                        <button type="submit" class="button start is-hidden">
                                            <span>Upload</span>
                                        </button>
                                        <button type="reset" class="button is-solid grey-button cancel">
                                            <span>Clear all</span>
                                        </button>
                                        <span class="file-count">
                                                <span id="modal-uploader-file-count">0</span> file(s) selected
                                        </span>
                                    </div>

                                    <div class="column is-12 is-hidden">
                                        <!-- The global file processing state -->
                                        <div class="fileupload-process">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="columns is-multiline" id="previews">

                                    <div id="template" class="column is-4 is-template">
                                        <div class="preview-box">
                                            <!-- This is used as the file preview template -->
                                            <div class="remove-button" data-dz-remove="">
                                                <i class="mdi mdi-close"></i>
                                            </div>
                                            <div>
                                                <span class="preview"><img src="https://via.placeholder.com/120x120" data-dz-thumbnail="" alt=""></span>
                                            </div>
                                            <div class="preview-body">
                                                <div class="item-meta">
                                                    <div>
                                                        <p class="name" data-dz-name="">
                                                        <strong class="error text-danger" data-dz-errormessage=""></strong>
                                                    </div>
                                                    <small class="size" data-dz-size=""></small>
                                                </div>
                                                <div class="upload-item-progress">
                                                    <div class="progress active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" data-dz-uploadprogress=""></div>
                                                    </div>
                                                </div>
                                                <div class="upload-item-description">
                                                    <div class="control">
                                                        <textarea class="textarea is-small is-fade no-radius" rows="4" placeholder="Describe this photo ..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="upload-item-actions is-hidden">
                                                    <button class="button start is-hidden">
                                                        <span>Start</span>
                                                    </button>
                                                    <button data-dz-remove="" class="button cancel is-hidden">
                                                        <span>Cancel</span>
                                                    </button>
                                                    <button data-dz-remove="" class="button delete is-hidden">
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Dropdown menu -->
                        <div class="dropdown is-up is-spaced is-modern is-neutral is-right dropdown-trigger">
                            <div>
                                <button class="button" aria-haspopup="true">
                                    <i class="main-icon" data-feather="smile"></i>
                                    <span>Friends</span>
                                    <i class="caret" data-feather="chevron-down"></i>
                                </button>
                            </div>
                            <div class="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                    <a href="#" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="globe"></i>
                                            <div class="media-content">
                                                <h3>Public</h3>
                                                <small>Anyone can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="users"></i>
                                            <div class="media-content">
                                                <h3>Friends</h3>
                                                <small>only friends can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="user"></i>
                                            <div class="media-content">
                                                <h3>Specific friends</h3>
                                                <small>Don't show it to some friends.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="lock"></i>
                                            <div class="media-content">
                                                <h3>Only me</h3>
                                                <small>Only me can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="button is-solid accent-button close-modal">Create album</button>
                    </div>
                </div>
            </div>
        </div>