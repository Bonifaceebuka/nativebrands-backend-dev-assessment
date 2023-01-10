<!-- Live video onboarding modal -->
        <!-- /partials/pages/feed/modals/videos-help-modal.html -->
        <div id="videos-help-modal" class="modal videos-help-modal is-xsmall has-light-bg">
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
                            <img src="/assets/img/illustrations/cards/videotrip.svg" alt="">
                            <div class="help-text">
                                <h3>Share live videos</h3>
                                <p>Lorem ipsum sit dolor amet is a dummy text used by the typography industry and the web industry.</p>
                            </div>
                        </div>

                        <div class="content-block">
                            <img src="/assets/img/illustrations/cards/videocall.svg" alt="">
                            <div class="help-text">
                                <h3>To build your audience</h3>
                                <p>Lorem ipsum sit dolor amet is a dummy text used by the typography industry and the web industry.</p>
                            </div>
                        </div>

                        <div class="slide-dots">
                            <div class="dot is-active"></div>
                            <div class="dot"></div>
                        </div>
                        <div class="action">
                            <button type="button" class="button is-solid accent-button next-modal raised" data-modal="videos-modal">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live video modal -->
        <!-- /partials/pages/feed/modals/videos-modal.html -->
        <div id="videos-modal" class="modal videos-modal is-xxl has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Go live</h3>
                        <div id="stop-stream" class="button is-solid accent-button is-hidden" onclick="stopWebcam();">
                            <i class="mdi mdi-video-off"></i>
                            Stop stream
                        </div>
                        <div id="start-stream" class="button is-solid accent-button" onclick="startWebcam();">
                            <i class="mdi mdi-video"></i>
                            Start stream
                        </div>


                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="inner">
                            <div class="left-section">
                                <div class="video-wrapper">
                                    <div class="video-wrap">
                                        <div id="live-indicator" class="live is-vhidden">Live</div>
                                        <video id="video" width="400" height="240" controls="" autoplay=""></video>
                                    </div>
                                </div>
                            </div>
                            <div class="right-section">
                                <div class="header">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/jenna.png" alt="">
                                    <div class="user-meta">
                                        <span>Jenna Davis <small>is live</small></span>
                                        <span><small>right now</small></span>
                                    </div>
                                    <button type="button" class="button">Follow</button>
                                    <div class="dropdown is-spaced is-right dropdown-trigger">
                                        <div>
                                            <div class="button">
                                                <i data-feather="more-vertical"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <div class="dropdown-item is-title">
                                                    Who can see this ?
                                                </div>
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
                                </div>

                                <div class="inner-content">
                                    <div class="control">
                                        <input type="text" class="input is-sm is-fade" placeholder="What is this live about?">
                                        <div class="icon">
                                            <i data-feather="activity"></i>
                                        </div>
                                    </div>
                                    <div class="live-stats">
                                        <div class="social-count">
                                            <div class="likes-count">
                                                <i data-feather="heart"></i>
                                                <span>0</span>
                                            </div>
                                            <div class="shares-count">
                                                <i data-feather="link-2"></i>
                                                <span>0</span>
                                            </div>
                                            <div class="comments-count">
                                                <i data-feather="message-circle"></i>
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="social-count ml-auto">
                                            <div class="views-count">
                                                <i data-feather="eye"></i>
                                                <span>0</span>
                                                <span class="views"><small>views</small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <div class="action">
                                            <i data-feather="thumbs-up"></i>
                                            <span>Like</span>
                                        </div>
                                        <div class="action">
                                            <i data-feather="message-circle"></i>
                                            <span>Comment</span>
                                        </div>
                                        <div class="action">
                                            <i data-feather="link-2"></i>
                                            <span>Share</span>
                                        </div>
                                        <div class="dropdown is-spaced is-right dropdown-trigger">
                                            <div>
                                                <div class="avatar-button">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/jenna.png" alt="">
                                                    <i data-feather="triangle"></i>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu has-margin" role="menu">
                                                <div class="dropdown-content">
                                                    <a href="#" class="dropdown-item is-selected">
                                                        <div class="media">
                                                            <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/jenna.png" alt="">
                                                            <div class="media-content">
                                                                <h3>Jenna Davis</h3>
                                                                <small>Interact as Jenna Davis.</small>
                                                            </div>
                                                            <div class="checkmark">
                                                                <i data-feather="check"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <hr class="dropdown-divider">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <img src="https://via.placeholder.com/478x344" data-demo-src="/assets/img/avatars/hanzo.svg" alt="">
                                                            <div class="media-content">
                                                                <h3>Css Ninja</h3>
                                                                <small>Interact as Css Ninja.</small>
                                                            </div>
                                                            <div class="checkmark">
                                                                <i data-feather="check"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs-wrapper">
                                    <div class="tabs is-fullwidth">
                                        <ul>
                                            <li class="is-active">
                                                <a>Comments</a>
                                            </li>
                                            <li>
                                                <a>Upcoming</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content has-slimscroll">
                                        <div class="media is-comment">
                                            <figure class="media-left">
                                                <p class="image is-32x32">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/dan.jpg" alt="" data-user-popover="1">
                                                </p>
                                            </figure>
                                            <div class="media-content">
                                                <div class="username">Dan Walker</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna
                                                    eros.</p>
                                                <div class="comment-actions">
                                                    <a href="javascript:void(0);" class="is-inverted">Like</a>
                                                    <span>3h</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="media is-comment">
                                            <figure class="media-left">
                                                <p class="image is-32x32">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/david.jpg" alt="" data-user-popover="4">
                                                </p>
                                            </figure>
                                            <div class="media-content">
                                                <div class="username">David Kim</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                                                <div class="comment-actions">
                                                    <a href="javascript:void(0);" class="is-inverted">Like</a>
                                                    <span>4h</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="media is-comment">
                                            <figure class="media-left">
                                                <p class="image is-32x32">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/rolf.jpg" alt="" data-user-popover="17">
                                                </p>
                                            </figure>
                                            <div class="media-content">
                                                <div class="username">Rolf Krupp</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna
                                                    eros. Consectetur adipiscing elit. Proin ornare magna eros.</p>
                                                <div class="comment-actions">
                                                    <a href="javascript:void(0);" class="is-inverted">Like</a>
                                                    <span>4h</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment-controls">
                                    <div class="controls-inner">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/jenna.png" alt="">
                                        <div class="control">
                                            <textarea class="textarea comment-textarea is-rounded" rows="1"></textarea>
                                            <button class="emoji-button">
                                                <i data-feather="smile"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
        <!-- Share from feed modal -->
        <!-- /partials/pages/feed/modals/share-modal.html -->
        <div id="share-modal" class="modal share-modal is-xsmall has-light-bg">
                <div class="modal-background"></div>
                <div class="modal-content">
    
                    <div class="card">
                        <div class="card-heading">
                            <div class="dropdown is-primary share-dropdown">
                                <div>
                                    <div class="button">
                                        <i class="mdi mdi-format-float-left"></i> <span>Share in your feed</span> <i data-feather="chevron-down"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" data-target-channel="feed">
                                            <div class="media">
                                                <i class="mdi mdi-format-float-left"></i>
                                                <div class="media-content">
                                                    <h3>Share in your feed</h3>
                                                    <small>Share this publication on your feed.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-item" data-target-channel="friend">
                                            <div class="media">
                                                <i class="mdi mdi-account-heart"></i>
                                                <div class="media-content">
                                                    <h3>Share in a friend's feed</h3>
                                                    <small>Share this publication on a friend's feed.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-item" data-target-channel="group">
                                            <div class="media">
                                                <i class="mdi mdi-account-group"></i>
                                                <div class="media-content">
                                                    <h3>Share in a group</h3>
                                                    <small>Share this publication in a group.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-item" data-target-channel="page">
                                            <div class="media">
                                                <i class="mdi mdi-file-document-box"></i>
                                                <div class="media-content">
                                                    <h3>Share in a page</h3>
                                                    <small>Share this publication in a page.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="dropdown-divider">
                                        <div class="dropdown-item" data-target-channel="private-message">
                                            <div class="media">
                                                <i class="mdi mdi-email-plus"></i>
                                                <div class="media-content">
                                                    <h3>Share in message</h3>
                                                    <small>Share this publication in a private message.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Close X button -->
                            <div class="close-wrap">
                                <span class="close-modal">
                                        <i data-feather="x"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="share-inputs">
                            <div class="field is-autocomplete">
                                <div id="share-to-friend" class="control share-channel-control is-hidden">
                                    <input id="share-with-friend" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Your friend's name">
                                    <div class="input-heading">
                                        Friend :
                                    </div>
                                </div>
                            </div>
    
                            <div class="field is-autocomplete">
                                <div id="share-to-group" class="control share-channel-control is-hidden">
                                    <input id="share-with-group" type="text" class="input is-sm no-radius share-input simple-groups-autocpl" placeholder="Your group's name">
                                    <div class="input-heading">
                                        Group :
                                    </div>
                                </div>
                            </div>
    
                            <div id="share-to-page" class="control share-channel-control no-border is-hidden">
                                <div class="page-controls">
                                    <div class="page-selection">
    
                                        <div class="dropdown is-accent page-dropdown">
                                            <div>
                                                <div class="button page-selector">
                                                    <img src="https://via.placeholder.com/150x150" data-demo-src="/assets/img/avatars/hanzo.svg" alt=""> <span>Css Ninja</span> <i data-feather="chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu" role="menu">
                                                <div class="dropdown-content">
                                                    <div class="dropdown-item">
                                                        <div class="media">
                                                            <img src="https://via.placeholder.com/150x150" data-demo-src="/assets/img/avatars/hanzo.svg" alt="">
                                                            <div class="media-content">
                                                                <h3>Css Ninja</h3>
                                                                <small>Share on Css Ninja.</small>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="dropdown-item">
                                                        <div class="media">
                                                            <img src="https://via.placeholder.com/150x150" data-demo-src="/assets/img/icons/logos/nuclearjs.svg" alt="">
                                                            <div class="media-content">
                                                                <h3>NuclearJs</h3>
                                                                <small>Share on NuclearJs.</small>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="dropdown-item">
                                                        <div class="media">
                                                            <img src="https://via.placeholder.com/150x150" data-demo-src="/assets/img/icons/logos/slicer.svg" alt="">
                                                            <div class="media-content">
                                                                <h3>Slicer</h3>
                                                                <small>Share on Slicer.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
    
                                    <div class="alias">
                                        <img src="https://via.placeholder.com/150x150" data-demo-src="/assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                            </div>
    
                            <div class="field is-autocomplete">
                                <div id="share-to-private-message" class="control share-channel-control is-hidden">
                                    <input id="share-with-private-message" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Message a friend">
                                    <div class="input-heading">
                                        To :
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="control">
                                <textarea class="textarea comment-textarea" rows="1" placeholder="Say something about this ..."></textarea>
                                <button class="emoji-button">
                                    <i data-feather="smile"></i>
                                </button>
                            </div>
                            <div class="shared-publication">
                                <div class="featured-image">
                                    <img id="share-modal-image" src="https://via.placeholder.com/1600x900" data-demo-src="/assets/img/demo/unsplash/1.jpg" alt="">
                                </div>
                                <div class="publication-meta">
                                    <div class="inner-flex">
                                        <img id="share-modal-avatar" src="https://via.placeholder.com/300x300" data-demo-src="/assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                                        <p id="share-modal-text">Yesterday with <a href="#">@Karen Miller</a> and <a href="#">@Marvin Stemperd</a> at the
                                            <a href="#">#Rock'n'Rolla</a> concert in LA. Was totally fantastic! People were really
                                            excited about this one!
                                        </p>
                                    </div>
                                    <div class="publication-footer">
                                        <div class="stats">
                                            <div class="stat-block">
                                                <i class="mdi mdi-earth"></i>
                                                <small>Public</small>
                                            </div>
                                            <div class="stat-block">
                                                <i class="mdi mdi-eye"></i>
                                                <small>163 views</small>
                                            </div>
                                        </div>
                                        <div class="publication-origin">
                                            <small>Friendkit.io</small>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                        <div class="bottom-share-inputs">
    
                            <div id="action-place" class="field is-autocomplete is-dropup is-hidden">
                                <div id="share-place" class="control share-bottom-channel-control">
                                    <input type="text" class="input is-sm no-radius share-input simple-locations-autocpl" placeholder="Where are you?">
                                    <div class="input-heading">
                                        Location :
                                    </div>
                                </div>
                            </div>
    
                            <div id="action-tag" class="field is-autocomplete is-dropup is-hidden">
                                <div id="share-tags" class="control share-bottom-channel-control">
                                    <input id="share-friend-tags-autocpl" type="text" class="input is-sm no-radius share-input" placeholder="Who are you with">
                                    <div class="input-heading">
                                        Friends :
                                    </div>
                                </div>
                                <div id="share-modal-tag-list" class="tag-list no-margin"></div>
                            </div>
    
                        </div>
                        <div class="card-footer">
                            <div class="action-wrap">
                                <div class="footer-action" data-target-action="tag">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <div class="footer-action" data-target-action="place">
                                    <i class="mdi mdi-map-marker"></i>
                                </div>
                                <div class="footer-action dropdown is-spaced is-neutral dropdown-trigger is-up" data-target-action="permissions">
                                    <div>
                                        <i class="mdi mdi-lock-clock"></i>
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
                            </div>
                            <div class="button-wrap">
                                <button type="button" class="button is-solid dark-grey-button close-modal">Cancel</button>
                                <button type="button" class="button is-solid primary-button close-modal">Publish</button>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
            <!-- No Stream modal -->
            <!-- /partials/pages/feed/modals/no-stream-modal.html -->
            <div id="no-stream-modal" class="modal no-stream-modal is-xsmall has-light-bg">
                <div class="modal-background"></div>
                <div class="modal-content">
    
                    <div class="card">
                        <div class="card-heading">
                            <h3></h3>
                            <!-- Close X button -->
                            <div class="close-wrap">
                                <span class="close-modal">
                                        <i data-feather="x"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="card-body has-text-centered">
    
                            <div class="image-wrap">
                                <img src="/assets/img/illustrations/characters/no-stream.svg" alt="">
                            </div>
    
                            <h3>Streaming Disabled</h3>
                            <p>Streaming is not allowed from mobile web. Please use our mobile apps for mobile streaming.</p>
    
                            <div class="action">
                                <a href="index.html#demos-section" class="button is-solid accent-button raised is-fullwidth">Got It</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>