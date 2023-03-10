@extends('layouts.user')
@section('title')
Settings
@endsection
@section('extra-styles')
<style>
    .cover-bg .cover-image {
    display: block;
    border-radius: 3px;
    -o-object-position: top;
    object-position: top;
    -o-object-fit: cover;
    object-fit: cover;
    width: 100%;
    max-height: 100px;
}
.cover-bg {
    position: relative;
    margin-bottom: 70px;
}
    .settings-form-wrapper .settings-form .avatar {
    position: absolute;
    bottom: -50px;
    left: 0;
    right: 0;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 110px;
    width: 110px;
    border-radius: 50%;
    z-index: 1;
    /* margin-bottom: 20px; */
}
.settings-form-wrapper .settings-form .avatar .avatar-image {
    position: relative;
    -o-object-fit: cover;
    object-fit: cover;
    height: 110px;
    width: 110px;
    border-radius: 50%;
    /* box-shadow: 0px 15px 32px rgba(0,0,0,.18) !important; */
    z-index: 1;
}
.settings-form-wrapper .settings-form .avatar .avatar-button {
    position: absolute;
    bottom: 0;
    right: 0;
    height: 34px;
    width: 34px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #3d70b2;
    box-shadow: 0 14px 26px -12px rgba(61,112,178,.42),0 4px 23px 0px rgba(0,0,0,.12),0 8px 10px -5px rgba(61,112,178,.2) !important;
    transform: rotate(0);
    transition: all .3s;
    cursor: pointer;
    z-index: 1;
}
.avatar-button svg {
    height: 18px;
    width: 18px;
    stroke: #fcfcfc;
}
.settings-form-wrapper .settings-form .avatar .pop-button.is-active.is-far-left {
    transform: translate(-240%, 30%) rotate(0);
}
.settings-form-wrapper .settings-form .avatar .pop-button .inner {
    position: relative;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.settings-form-wrapper .settings-form .avatar .pop-button.is-far-left svg {
    stroke: #757a91;
}
.settings-form-wrapper .settings-form .avatar .pop-button {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    margin: 0 auto;
    height: 34px;
    width: 34px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 14px 26px -12px rgba(85,150,230,.42),0 4px 23px 0px rgba(0,0,0,.12),0 8px 10px -5px rgba(85,150,230,.2) !important;
    z-index: 0;
    transform: translate(0, 10px) rotate(260deg);
    transition: all .3s;
    cursor: pointer;
}
.settings-wrapper .settings-section .settings-panel .settings-form .switch-block .meta {
    margin-left: 10px;
    margin-right: 10px;
}
.alert{
        display:none;
        padding: 10px;
        text-align: center;
        margin-bottom: 10px;
    }
    .alert.alert-success {
        border-left: 5px #1ece1e solid;
        background: azure;
    }
    .alert.alert-danger{
        background:#ec8181;
        border-left: 5px solid #df0000;
        color: #fff;
    }
    .settings-wrapper .settings-section .settings-panel .settings-form .field-group label.error,
    .error {
        color: #ff0000 !important;
    }
    .success {
        color: #1ece1e !important;
    }
    #username-msg {
    float: right;
    padding: 6px;
    display: none;
    }

</style>
@php
$BaseController = new \App\Http\Controllers\BaseController();
@endphp
<link rel="stylesheet" href="{{asset('/assets/js/sweetalert/sweetalert.css')}}">
@endsection
@section('content')
<div class="view-wrapper is-full">
        <div class="settings-sidebar is-active">
            <div class="settings-sidebar-inner">
                <div class="user-block">
                    <a class="close-settings-sidebar is-hidden">
                        <i data-feather="x"></i>
                    </a>
                    <div class="avatar-wrap">
                        <img src="https://via.placeholder.com/150x150" 
                        data-demo-src="{{$BaseController->find_image('profile_image',Auth::user()->id)}}" data-user-popover="0" alt="">
                        <div class="badge">
                            <i data-feather="check"></i>
                        </div>
                    </div>
                    <h4>{{$BaseController->full_name(Auth::user()->id)}}</h4>
                    <p>Melbourne, AU</p>
                </div>
                <div class="user-menu">
                    <div class="user-menu-inner has-slimscroll">
                        <div class="menu-block">
                            <ul>
                                <li data-section="general" class="is-active">
                                    <a>
                                        <i data-feather="settings"></i>
                                        <span>General</span>
                                    </a>
                                </li>
                                <li data-section="security">
                                    <a>
                                        <i data-feather="shield"></i>
                                        <span>Security</span>
                                    </a>
                                </li>
                                <li data-section="personal">
                                    <a>
                                        <i data-feather="alert-triangle"></i>
                                        <span>Account</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="separator"></div>
                        <div class="menu-block">
                            <ul>
                                <li data-section="privacy">
                                    <a>
                                        <i data-feather="lock"></i>
                                        <span>Privacy</span>
                                    </a>
                                </li>
                                <li data-section="preferences">
                                    <a>
                                        <i data-feather="sliders"></i>
                                        <span>Preferences</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="separator"></div>
                        <div class="menu-block">
                            <ul>
                                <li data-section="notifications">
                                    <a>
                                        <i data-feather="bell"></i>
                                        <span>Notifications</span>
                                    </a>
                                </li>
                                <li data-section="support">
                                    <a>
                                        <i data-feather="life-buoy"></i>
                                        <span>Help</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="settings-wrapper">

            <!-- /partials/settings/sections/general-settings.html -->
            <div id="general-settings" class="settings-section is-active">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Profile Settings</h2>
                    </div>
                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                                    <div class="cover-bg">
                                            <img class="cover-image"
                                            src="{{$BaseController->find_image('cover_image',Auth::user()->id)}}" 
                                            data-demo-src="{{$BaseController->find_image('cover_image',Auth::user()->id)}}"
                                            alt="">
                                            <div class="avatar">
                                                    <img id="user-avatar" class="avatar-image" 
                                                    src="{{$BaseController->find_image('profile_image',Auth::user()->id)}}" data-demo-src="{{$BaseController->find_image('profile_image',Auth::user()->id)}}" alt="">
                                                <div class="avatar-button has-tooltip modal-trigger" data-modal="change-profile-pic-modal" 
                                                data-placement="right" data-title="Change profile picture" data-original-title="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                                stroke-width="2" stroke-linecap="round" 
                                                stroke-linejoin="round" class="feather feather-camera">
                                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                                </path><circle cx="12" cy="13" r="4"></circle></svg>
                                        </div>
                                            </div>
                                            <div class="cover-overlay"></div>
                                            <div class="cover-edit modal-trigger" data-modal="change-cover-modal">
                                                <i class="mdi mdi-camera"></i>
                                                <span>Edit cover image</span>
                                            </div>
                                            <div class="dropdown is-spaced is-right is-accent dropdown-trigger timeline-mobile-dropdown is-hidden-desktop">
                                                <div>
                                                    <div class="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="/profile-main.html" class="dropdown-item">
                                                            <div class="media">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                                                <div class="media-content">
                                                                    <h3>Timeline</h3>
                                                                    <small>Open Timeline.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="/profile-about.html" class="dropdown-item">
                                                            <div class="media">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-right"><line x1="21" y1="10" x2="7" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="7" y2="18"></line></svg>
                                                                <div class="media-content">
                                                                    <h3>About</h3>
                                                                    <small>See about info.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="/profile-friends.html" class="dropdown-item">
                                                            <div class="media">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                <div class="media-content">
                                                                    <h3>Friends</h3>
                                                                    <small>See friends.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="/profile-photos.html" class="dropdown-item">
                                                            <div class="media">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                                <div class="media-content">
                                                                    <h3>Photos</h3>
                                                                    <small>See all photos.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <form action="#" id="personal-settings" name="personal-settings">
                                @csrf
                                <div class="columns is-multiline">
                                    <div class="column is-6">
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>First Name</label>
                                            <div class="control has-icon">
                                                <input type="text" class="input is-fade" 
                                                value="{{old('fname')}}" name="fname">
                                                <div class="form-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>Email</label>
                                            <div class="control has-icon">
                                                <input type="text" class="input is-fade" 
                                                value="{{Auth::user()->email}}"
                                                readonly disabled>
                                                <div class="form-icon">
                                                    <i data-feather="mail"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field spaced-field">
                                            <div class="switch-block">
                                                <label>
                                                    <input checked="" type="radio"  name="gender" value="male">
                                                    <i></i>
                                                </label>
                                                <div class="meta">
                                                    <h4>Male</h4>
                                                </div>
                                                <label>
                                                    <input checked="" type="radio"  name="gender" value="female">
                                                    <i></i>
                                                </label>
                                                <div class="meta">
                                                    <h4>Female</h4>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="column is-6">
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>Last Name</label>
                                            <div class="control has-icon">
                                                <input type="text" class="input is-fade"  
                                                value="{{old('lname')}}" name="lname">
                                                <div class="form-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>Username</label>
                                            <label id="username-msg" for="username"></label>
                                            <div class="control has-icon">
                                                <input type="text" class="input is-fade"  
                                                value="{{old('username')}}" name="username" id="username">
                                                <div class="form-icon">
                                                    <i>@</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field field-group">
                                            <label>Birth date</label>
                                            <div class="control has-icon">
                                                <input type="date" class="input is-fade"  
                                                value="{{old('birthdate')}}" name="birthdate">
                                                <div class="form-icon">
                                                    <i data-feather="calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="column is-12">
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>Bio</label>
                                            <div class="control">
                                                <textarea type="text" class="textarea is-fade" 
                                                rows="1" placeholder="Fill in your address..." name="bio">{{old('bio')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="column is-12">
                                        <!--Field-->
                                        <div class="form-text">
                                            <p>Be sure to fill out your location settings. This will help us suggest you relevant friends and places you could like.</p>
                                        </div>
                                    </div>
    
                                    <div class="column is-6">
                                        <!--Field-->
                                        <div class="field field-group">
                                            <label>State</label>
                                            <div class="control has-icon">
                                                <input type="text" class="input is-fade" name="state">
                                                <div class="form-icon">
                                                    <i data-feather="map-pin"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="column is-6">
                                        <!--Field-->
                                        <div class="field field-group is-autocomplete">
                                            <label>Country</label>
                                            <div class="control has-icon">
                                                <input id="country-autocpl" type="text" class="input is-fade" name="country">
                                                <div class="form-icon">
                                                    <i data-feather="globe"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="column is-12">
                                        <div class="buttons">
                                            <button type="submit" 
                                            class="button is-solid accent-button 
                                            form-button" id="submit-personal-settings">Save Changes</button>
                                        </div>
                                    </div>
    
                                </div>
                            </form>
                        </div>

                        <div class="illustration">
                            <img class="light-image" src="assets\img\illustrations\settings\1.svg" alt="">
                            <img class="dark-image" src="assets\img\illustrations\settings\1-dark.svg" alt="">
                            <p>If you'd like to learn more about general settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /partials/settings/sections/security-settings.html -->
            <div id="security-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Security</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline">

                                <div class="column is-12">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Current Password</label>
                                        <div class="control has-icon">
                                            <input type="password" class="input is-fade" value="testpassword">
                                            <div class="form-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>New Password</label>
                                        <div class="control has-icon">
                                            <input type="password" class="input is-fade" value="">
                                            <div class="form-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Repeat Password</label>
                                        <div class="control has-icon">
                                            <input type="password" class="input is-fade" value="">
                                            <div class="form-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <!--Field-->
                                    <div class="form-text">
                                        <p>You can enable 2 factor authentication anytime to improve your account privacy and security.</p>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch is-success">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Enable 2 factor auth</h4>
                                                <p>This will send an additional code to your phone number.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Phone Number</label>
                                        <div class="control has-icon">
                                            <input type="text" class="input is-fade" value="">
                                            <div class="form-icon">
                                                <i data-feather="smartphone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <div class="buttons">
                                        <button class="button is-solid accent-button form-button">Save Changes</button>
                                        <button class="button is-light form-button">Advanced</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img src="assets\img\illustrations\settings\2.svg" alt="">
                            <p>If you'd like to learn more about security settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /partials/settings/sections/personal-settings.html -->
            <div id="personal-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Personal</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline flex-portrait">
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <h4>Personal Info</h4>
                                            <p>Access your personal info</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="clock"></i>
                                            </div>
                                            <h4>History</h4>
                                            <p>Access private history</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="download-cloud"></i>
                                            </div>
                                            <h4>Download</h4>
                                            <p>Download your data</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="codepen"></i>
                                            </div>
                                            <h4>Connected Apps</h4>
                                            <p>Manage connected apps</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="credit-card"></i>
                                            </div>
                                            <h4>Payment Info</h4>
                                            <p>Manage payment info</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="hexagon"></i>
                                            </div>
                                            <h4>Account</h4>
                                            <p>Manage account info</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="github"></i>
                                            </div>
                                            <h4>Integrations</h4>
                                            <p>Manage integrations</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="shopping-cart"></i>
                                            </div>
                                            <h4>Shop Settings</h4>
                                            <p>Manage your store</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="database"></i>
                                            </div>
                                            <h4>System Settings</h4>
                                            <p>Manage preferences</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img class="light-image" src="assets\img\illustrations\settings\3.svg" alt="">
                            <img class="dark-image" src="assets\img\illustrations\settings\3-dark.svg" alt="">
                            <p>If you'd like to learn more about account settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /partials/settings/sections/privacy-settings.html -->
            <div id="privacy-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Privacy Settings</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline">
                                <div class="column is-8">
                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Public Profile</h4>
                                                <p>Enable to make your profile viewable by anyone.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Public Posts</h4>
                                                <p>Enable to make your posts viewable by anyone.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Free Tagging</h4>
                                                <p>Enable to disable tags verification before publish.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Public List</h4>
                                                <p>Enable to make your friend list viewable by anyone.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>SEO</h4>
                                                <p>Enable to make your profile indexable by search engines.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img class="light-image" src="assets\img\illustrations\settings\4.svg" alt="">
                            <img class="dark-image" src="assets\img\illustrations\settings\4-dark.svg" alt="">
                            <p>If you'd like to learn more about privacy settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /partials/settings/sections/preferences-settings.html -->
            <div id="preferences-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Preferences</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline flex-portrait">
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="monitor"></i>
                                            </div>
                                            <h4>Devices</h4>
                                            <p>Manage connected devices</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="codesandbox"></i>
                                            </div>
                                            <h4>Authentication</h4>
                                            <p>Authentication settings</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="box"></i>
                                            </div>
                                            <h4>API</h4>
                                            <p>API settings</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="search"></i>
                                            </div>
                                            <h4>Search</h4>
                                            <p>Search settings</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="cloud-snow"></i>
                                            </div>
                                            <h4>Cloud Settings</h4>
                                            <p>Manage storage</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="cpu"></i>
                                            </div>
                                            <h4>Cache</h4>
                                            <p>Cache settings</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="gift"></i>
                                            </div>
                                            <h4>Reedeem</h4>
                                            <p>Reedeem your points</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="command"></i>
                                            </div>
                                            <h4>Shortcuts</h4>
                                            <p>manage shortcuts</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="layout"></i>
                                            </div>
                                            <h4>Layout</h4>
                                            <p>Layout settings</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img class="light-image" src="assets\img\illustrations\settings\5.svg" alt="">
                            <img class="dark-image" src="assets\img\illustrations\settings\5-dark.svg" alt="">
                            <p>If you'd like to learn more about preferences settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /partials/settings/sections/notifications-settings.html -->
            <div id="notifications-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Notifications</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline">
                                <div class="column is-8">

                                    <div class="sub-heading">
                                        <h3>General notifications</h3>
                                    </div>

                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Notifications</h4>
                                                <p>Enable to activate notifications.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Sounds</h4>
                                                <p>Enable to play a sound on new notification.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-heading">
                                        <h3>Social notifications</h3>
                                    </div>

                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Friend Request</h4>
                                                <p>Enable to receive friend request notifications.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>New Comment</h4>
                                                <p>Enable to receive new comment notifications.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-heading">
                                        <h3>Chat notifications</h3>
                                    </div>

                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>New Message</h4>
                                                <p>Enable to receive new message notifications.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>New Participant</h4>
                                                <p>Enable to receive new participant notifications.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-heading">
                                        <h3>Payment notifications</h3>
                                    </div>

                                    <!--Field-->
                                    <div class="field spaced-field">
                                        <div class="switch-block">
                                            <label class="f-switch is-accent">
                                                <input type="checkbox" class="is-switch" checked="">
                                                <i></i>
                                            </label>
                                            <div class="meta">
                                                <h4>Payment Status</h4>
                                                <p>Enable to receive a notification on payment status change.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img src="assets\img\illustrations\settings\6.svg" alt="">
                            <p>If you'd like to learn more about notifications settings, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /partials/settings/sections/support-settings.html -->
            <div id="support-settings" class="settings-section">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <a class="mobile-sidebar-trigger">
                            <i data-feather="menu"></i>
                        </a>
                        <h2>Assistance</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <div class="columns is-multiline flex-portrait">
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="book-open"></i>
                                            </div>
                                            <h4>User Guide</h4>
                                            <p>Learn more about the app</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="mail"></i>
                                            </div>
                                            <h4>Message</h4>
                                            <p>Contact the support team</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="message-circle"></i>
                                            </div>
                                            <h4>Chat</h4>
                                            <p>Chat with support</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="slash"></i>
                                            </div>
                                            <h4>Blocked Users</h4>
                                            <p>Manage blocked users</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="archive"></i>
                                            </div>
                                            <h4>Archives</h4>
                                            <p>Manage archives</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="flag"></i>
                                            </div>
                                            <h4>Report</h4>
                                            <p>Report offenses</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="award"></i>
                                            </div>
                                            <h4>Rewards</h4>
                                            <p>See your rewards</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="check-circle"></i>
                                            </div>
                                            <h4>Partners</h4>
                                            <p>Partner Programs</p>
                                        </div>
                                    </a>
                                </div>
                                <!--link-->
                                <div class="column is-4">
                                    <a class="setting-sublink">
                                        <div class="link-content">
                                            <div class="link-icon">
                                                <i data-feather="briefcase"></i>
                                            </div>
                                            <h4>Sponsors</h4>
                                            <p>Sponsor programs</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <img class="light-image" src="assets\img\illustrations\settings\7.svg" alt="">
                            <img class="dark-image" src="assets\img\illustrations\settings\7-dark.svg" alt="">
                            <p>If you'd like to learn more about support, you can read about it in the <a>user guide</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="chat-wrapper">
        <div class="chat-inner">

            <!-- Chat top navigation -->
            <div class="chat-nav">
                <div class="nav-start">
                    <div class="recipient-block">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        </div>
                        <div class="username">
                            <span>Dan Walker</span>
                            <span><i data-feather="star"></i> <span>| Online</span></span>
                        </div>
                    </div>
                </div>
                <div class="nav-end">

                    <!-- Settings icon dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon">
                                <i data-feather="settings"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="message-square"></i>
                                        <div class="media-content">
                                            <h3>Details</h3>
                                            <small>View this conversation's details.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="settings"></i>
                                        <div class="media-content">
                                            <h3>Preferences</h3>
                                            <small>Define your preferences.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell"></i>
                                        <div class="media-content">
                                            <h3>Notifications</h3>
                                            <small>Set notifications settings.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell-off"></i>
                                        <div class="media-content">
                                            <h3>Silence</h3>
                                            <small>Disable notifications.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="box"></i>
                                        <div class="media-content">
                                            <h3>Archive</h3>
                                            <small>Archive this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="trash-2"></i>
                                        <div class="media-content">
                                            <h3>Delete</h3>
                                            <small>Delete this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-search">
                        <div class="control has-icon">
                            <input type="text" class="input" placeholder="Search messages">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="at-sign"></i>
                    </a>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="star"></i>
                    </a>

                    <!-- More dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon no-margin">
                                <i data-feather="more-vertical"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="file-text"></i>
                                        <div class="media-content">
                                            <h3>Files</h3>
                                            <small>View all your files.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="users"></i>
                                        <div class="media-content">
                                            <h3>Users</h3>
                                            <small>View all users you're talking to.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="gift"></i>
                                        <div class="media-content">
                                            <h3>Daily bonus</h3>
                                            <small>Get your daily bonus.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="download-cloud"></i>
                                        <div class="media-content">
                                            <h3>Downloads</h3>
                                            <small>See all your downloads.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="life-buoy"></i>
                                        <div class="media-content">
                                            <h3>Support</h3>
                                            <small>Reach our support team.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon close-chat">
                        <i data-feather="x"></i>
                    </a>
                </div>
            </div>
            <!-- Chat sidebar -->
            <div id="chat-sidebar" class="users-sidebar">
                <!-- Header -->
                <div class="header-item">
                    <img class="light-image" src="assets\img\logo\friendkit-bold.svg" alt="">
                    <img class="dark-image" src="assets\img\logo\friendkit-white.svg" alt="">
                </div>
                <!-- User list -->
                <div class="conversations-list has-slimscroll-xs">
                    <!-- User -->
                    <div class="user-item is-active" data-chat-user="dan" data-full-name="Dan Walker" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="stella" data-full-name="Stella Bergmann" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="daniel" data-full-name="Daniel Wellington" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="david" data-full-name="David Kim" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="edward" data-full-name="Edward Mayers" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="elise" data-full-name="Elise Walker" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="nelly" data-full-name="Nelly Schwartz" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="milly" data-full-name="Milly Augustine" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                </div>
                <!-- Add Conversation -->
                <div class="footer-item">
                    <div class="add-button modal-trigger" data-modal="add-conversation-modal"><i data-feather="user"></i></div>
                </div>
            </div>

            <!-- Chat body -->
            <div id="chat-body" class="chat-body is-opened">
                <!-- Conversation with Dan -->
                <div id="dan-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">Hi Jenna! I made a new design, and i wanted to show it to you.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">It's quite clean and it's inspired from Bulkit.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:12am</span>
                            <div class="message-text">Oh really??! I want to see that.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:13am</span>
                            <div class="message-text">FYI it was done in less than a day.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:17am</span>
                            <div class="message-text">Great to hear it. Just send me the PSD files so i can have a look at it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:18am</span>
                            <div class="message-text">And if you have a prototype, you can also send me the link to it.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Stella -->
                <div id="stella-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:34am</span>
                            <div class="message-text">Hey Stella! Aren't we supposed to go the theatre after work?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:37am</span>
                            <div class="message-text">Just remembered it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                        <div class="message-block">
                            <span>11:22am</span>
                            <div class="message-text">Yeah you always do that, forget about everything.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Daniel -->
                <div id="daniel-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Yesterday</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>3:24pm</span>
                            <div class="message-text">Daniel, Amanda told me about your issue, how can I help?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:42pm</span>
                            <div class="message-text">Hey Jenna, thanks for answering so quickly. Iam stuck, i need a car.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:43pm</span>
                            <div class="message-text">Can i borrow your car for a quick ride to San Fransisco? Iam running behind and
                                there' no train in sight.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with David -->
                <div id="david-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:34pm</span>
                            <div class="message-text">Damn you! Why would you even implement this in the game?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:32pm</span>
                            <div class="message-text">I just HATE aliens.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:09pm</span>
                            <div class="message-text">C'mon, you just gotta learn the tricks. You can't expect aliens to behave like
                                humans. I mean that's how the mechanics are.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:11pm</span>
                            <div class="message-text">I checked the replay and for example, you always get supply blocked. That's not
                                the right thing to do.</div>
                        </div>
                    </div>
                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>13:12pm</span>
                            <div class="message-text">I know but i struggle when i have to decide what to make from larvas.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:17pm</span>
                            <div class="message-text">Join me in game, i'll show you.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="edward-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Monday</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:55pm</span>
                            <div class="message-text">Hey Jenna, what's up?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:56pm</span>
                            <div class="message-text">Iam coming to LA tomorrow. Interested in having lunch?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:21pm</span>
                            <div class="message-text">Hey mate, it's been a while. Sure I would love to.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">Ok. Let's say i pick you up at 12:30 at work, works?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:43pm</span>
                            <div class="message-text">Yup, that works great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:44pm</span>
                            <div class="message-text">And yeah, don't forget to bring some of my favourite cheese cake.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">No worries</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="elise-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 28</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">Elise, i forgot my folder at your place yesterday.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">I need it badly, it's work stuff.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                        <div class="message-block">
                            <span>12:19pm</span>
                            <div class="message-text">Yeah i noticed. I'll drop it in half an hour at your office.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Nelly -->
                <div id="nelly-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 17</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">So you watched the movie?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">Was it scary?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                        <div class="message-block">
                            <span>9:03pm</span>
                            <div class="message-text">It was so frightening, i felt my heart was about to blow inside my chest.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Milly -->
                <div id="milly-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Hello Jenna, did you read my proposal?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Didn't hear from you since i sent it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:02pm</span>
                            <div class="message-text">Hello Milly, Iam really sorry, Iam so busy recently, but i had the time to read
                                it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:04pm</span>
                            <div class="message-text">And what did you think about it?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:05pm</span>
                            <div class="message-text">Actually it's quite good, there might be some small changes but overall it's
                                great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:07pm</span>
                            <div class="message-text">I think that i can give it to my boss at this stage.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:09pm</span>
                            <div class="message-text">Crossing fingers then</div>
                        </div>
                    </div>
                </div>
                <!-- Compose message area -->
                <div class="chat-action">
                    <div class="chat-action-inner">
                        <div class="control">
                            <textarea class="textarea comment-textarea" rows="1"></textarea>
                            <div class="dropdown compose-dropdown is-spaced is-accent is-up dropdown-trigger">
                                <div>
                                    <div class="add-button">
                                        <div class="button-inner">
                                            <i data-feather="plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="code"></i>
                                                <div class="media-content">
                                                    <h3>Code snippet</h3>
                                                    <small>Add and paste a code snippet.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="file-text"></i>
                                                <div class="media-content">
                                                    <h3>Note</h3>
                                                    <small>Add and paste a note.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="server"></i>
                                                <div class="media-content">
                                                    <h3>Remote file</h3>
                                                    <small>Add a file from a remote drive.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="monitor"></i>
                                                <div class="media-content">
                                                    <h3>Local file</h3>
                                                    <small>Add a file from your computer.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="chat-panel" class="chat-panel is-opened">
                <div class="panel-inner">
                    <div class="panel-header">
                        <h3>Details</h3>
                        <div class="panel-close">
                            <i data-feather="x"></i>
                        </div>
                    </div>

                    <!-- Dan details -->
                    <div id="dan-details" class="panel-body is-user-details">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Dan Walker</h3>
                                <h4>IOS Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">WebSmash Inc.</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-school"></i>
                                    <div class="about-text">
                                        <span>Studied at</span>
                                        <span><a class="is-inverted" href="#">Riverdale University</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Stella details -->
                    <div id="stella-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Stella Bergmann</h3>
                                <h4>Shop Owner</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-purple">
                                    <div>
                                        <i class="mdi mdi-bomb"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-check-decagram"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Trending Fashions</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Oklahoma City</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Daniel details -->
                    <div id="daniel-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Daniel Wellington</h3>
                                <h4>Senior Executive</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-google-cardboard"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-pizza"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-linux"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-puzzle"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Peelman & Sons</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Los Angeles</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- David details -->
                    <div id="david-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>David Kim</h3>
                                <h4>Senior Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Frost Entertainment</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Chicago</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Edward details -->
                    <div id="edward-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Edward Mayers</h3>
                                <h4>Financial analyst</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Brettmann Bank</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Santa Fe</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Elise details -->
                    <div id="elise-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Elise Walker</h3>
                                <h4>Social influencer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Social Media</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">London</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Nelly details -->
                    <div id="nelly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Nelly Schwartz</h3>
                                <h4>HR Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Carrefour</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Melbourne</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Milly details -->
                    <div id="milly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Milly Augustine</h3>
                                <h4>Sales Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Salesforce</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Seattle</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add-conversation-modal" class="modal add-conversation-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>New Conversation</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">

                    <img src="assets\img\icons\chat\bubbles.svg" alt="">

                    <div class="field is-autocomplete">
                        <div class="control has-icon">
                            <input type="text" class="input simple-users-autocpl" placeholder="Search a user">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="help-text">
                        Select a user to start a new conversation. You'll be able to add other users later.
                    </div>

                    <div class="action has-text-centered">
                        <button type="button" class="button is-solid accent-button raised">Start conversation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explorer-menu">
        <div class="explorer-inner">
            <div class="explorer-container">
                <!--Header-->
                <div class="explorer-header">
                    <h3>Explore</h3>
                    <div class="control">
                        <input type="text" class="input is-rounded is-fade" placeholder="Filter">
                        <div class="form-icon">
                            <i data-feather="filter"></i>
                        </div>
                    </div>
                </div>
                <!--List-->
                <div class="explore-list has-slimscroll">
                    <!--item-->
                    <a href="navbar-v1-feed.html" class="explore-item">
                        <img src="assets\img\icons\explore\clover.svg" alt="">
                        <h4>Feed</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-profile-friends.html" class="explore-item">
                        <img src="assets\img\icons\explore\friends.svg" alt="">
                        <h4>Friends</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-videos-home.html" class="explore-item">
                        <img src="assets\img\icons\explore\videos.svg" alt="">
                        <h4>Videos</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-pages-main.html" class="explore-item">
                        <img src="assets\img\icons\explore\tag-euro.svg" alt="">
                        <h4>Pages</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-ecommerce-products.html" class="explore-item">
                        <img src="assets\img\icons\explore\cart.svg" alt="">
                        <h4>Commerce</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-groups.html" class="explore-item">
                        <img src="assets\img\icons\explore\house.svg" alt="">
                        <h4>Interests</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-stories-main.html" class="explore-item">
                        <img src="assets\img\icons\explore\chrono.svg" alt="">
                        <h4>Stories</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-questions-home.html" class="explore-item">
                        <img src="assets\img\icons\explore\question.svg" alt="">
                        <h4>Questions</h4>
                    </a>
                    <!--item-->
                    <a href="news.html" class="explore-item">
                        <img src="assets\img\icons\explore\news.svg" alt="">
                        <h4>News</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-groups.html" class="explore-item">
                        <img src="assets\img\icons\explore\cake.svg" alt="">
                        <h4>Groups</h4>
                    </a>
                    <!--item-->
                    <a href="https://envato.com" class="explore-item">
                        <img src="assets\img\icons\explore\envato.svg" alt="">
                        <h4>Envato</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-events.html" class="explore-item">
                        <img src="assets\img\icons\explore\calendar.svg" alt="">
                        <h4>Events</h4>
                    </a>
                    <!--item-->
                    <a href="https://cssninja.io" target="_blank" class="explore-item">
                        <img src="assets\img\icons\explore\pin.svg" alt="">
                        <h4>Css Ninja</h4>
                    </a>
                    <!--item-->
                    <a href="elements.html" class="explore-item">
                        <img src="assets\img\icons\explore\idea.svg" alt="">
                        <h4>Elements</h4>
                    </a>
                    <!--item-->
                    <a href="navbar-v1-settings.html" class="explore-item">
                        <img src="assets\img\icons\explore\settings.svg" alt="">
                        <h4>Settings</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
@include('user._components.cover_upload')
@include('user._components.profile_upload')
@endsection
@section('extra-js')
<script src="{{asset('/assets/js/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/assets/js/api-clients/api-int-functions.js')}}"></script>
<script src="{{asset('/assets/js/custom/settings.js')}}"></script>
@endsection