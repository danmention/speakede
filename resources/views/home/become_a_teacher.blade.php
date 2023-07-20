@extends('home.template')
@section('content')

    <link rel="stylesheet" href="{{asset("home/assets/css/user.css")}}">

    <div class="flex-container">
        <form class="ant-form ant-form-horizontal">
            <div class="TeacherApply-body">
                <div class="TeacherApply-step-box">
                    <div class="TeacherApply-step-box-title">2.1 <span>Basic Information</span></div>
                    <div class="TeacherApply-form-row">
                        <div class="full-width">
                            <div class="TeacherApply-form-label"><span>Display Name</span><span class="tooltip-container-box TeacherApply-form-label-icon" gap="5">
                                <span class="tooltip-container" placement="right"></span></span></div>
                            <div class="TeacherApply-form-input full-width">
                                <div class="undefined Text-container">
                                    <input type="text" class="text-common undefined undefined" placeholder="Display Name" dec="0" value="wise.princeisz" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="TeacherApply-form-row">
                        <div style="width: 100%;"><span class="TeacherApply-form-label">Preferred IM/Chat</span>
                            <div class="TeacherApply-form-row">
                                <div class="flex full-width">

                                    <div class="ant-row ant-form-item form_item" style="margin-bottom: 0px;">
                                        <div class="ant-col ant-form-item-control">
                                            <div class="ant-form-item-control-input">
                                                <div class="ant-form-item-control-input-content">
                                                    <select class="ant-input tools-input">
                                                        <option>Skype</option>
                                                        <option>Google Hangouts</option>
                                                        <option>Wechat</option>
                                                        <option>Zoom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-tool-click">+ <span>Add a communication tool</span></div>
                        </div>
                    </div>
                    <div class="TeacherApply-form-row">
                        <div>
                            <div class="TeacherApply-form-label"><span>From</span><span
                                    class=" text-gray4 text-tiny ml-2">Note: You can't change key information such as where you are from once you have finished onboarding.</span>
                            </div>
                            <div>
                                <div class="cityMenu">
                                    <div>
                                        <div class="menu menu-style-default menu-hide"
                                             style="width: 363px; margin-right: 20px;">
                                            <select class="ant-input tools-input">
                                                <option>Ireland</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <div class="menu menu-style-default menu-hide" style="width: 363px;">
                                                <select class="ant-input tools-input">
                                                    <option>Other</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="TeacherApply-form-row">
                        <div>
                            <div class="TeacherApply-form-label"><span>Living in</span></div>
                            <div>
                                <div class="cityMenu">
                                    <div>
                                        <div class="menu menu-style-default menu-hide"
                                             style="width: 363px; margin-right: 20px;">
                                            <select class="ant-input tools-input">
                                                <option>Ireland</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <div class="menu menu-style-default menu-hide" style="width: 363px;">

                                                <select class="ant-input tools-input">
                                                    <option>Other</option>
                                                </select>

                                                <input
                                                    placeholder="Choose" type="text"
                                                    style="border-radius: 4px 4px 0px 0px;">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TeacherApply-step-box">
                    <div class="TeacherApply-step-box-title">2.2 <span>Private</span></div>
                    <div class="TeacherApply-step-box-tips"><span>Please make sure your information is identical to your government-issued ID.</span><a href="#" target="_blank" rel="noopener noreferrer" class="learn-more"><span>Learn more</span></a>
                        <p><span class=" mt-3 text-tiny text-gray4 block">Note: You can’t change key information such as your name, birthday, and gender once you have finished onboarding.</span>
                        </p></div>
                    <div class="TeacherApply-form-row">
                        <div>
                            <div class="TeacherApply-form-label"><span>First Name</span></div>
                            <div class="undefined Text-container">
                                <input type="text" class="text-common undefined undefined" placeholder="First Name"
                                       maxlength="20" dec="0" value="" style="width: 363px; margin-right: 20px;">
                            </div>
                        </div>
                        <div>
                            <div class="TeacherApply-form-label"><span>Last Name</span></div>
                            <div class="undefined Text-container">
                                <input type="text" class="text-common undefined undefined" placeholder="Last Name"
                                       maxlength="20" dec="0" value="" style="width: 363px;"></div>
                        </div>
                    </div>
                    <div class="TeacherApply-form-row">
                        <div>
                            <div class="TeacherApply-form-label"><span>Birthday</span></div>
                            <div class="TeacherApply-birthday-wrapper">
                                <div>
                                    <div class="menu menu-style-default menu-hide"
                                         style="width: 175px; margin-right: 20px;">

                                        <select class="ant-input tools-input">
                                            <option>Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="menu menu-style-default menu-hide"
                                         style="width: 175px; margin-right: 20px;">
                                        <select class="ant-input tools-input">
                                            <option>month</option>
                                        </select>

                                    </div>
                                </div>
                                <div>
                                    <div class="menu menu-style-default menu-hide"
                                         style="width: 100px; margin-right: 70px;">

                                        <select class="ant-input tools-input">
                                            <option>Day</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="TeacherApply-form-label"><span>Gender</span></div>
                            <div class="menu menu-style-default menu-hide" style="width: 187px;">
                                <select class="ant-input tools-input">
                                    <option>Gender</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="TeacherApply-form-row">
                        <div class="full-width">
                            <div class="TeacherApply-form-label"><span>Street Address</span></div>
                            <div class="TeacherApply-form-input full-width">
                                <div class="undefined Text-container">
                                    <input type="text" class="text-common undefined undefined"
                                           placeholder="Your street address" maxlength="100" dec="0" value=""
                                           style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TeacherApply-step-box">
                    <div class="TeacherApply-step-box-title">2.3 <span>Language Skills</span></div>
                    <div class="TeacherApply-step-box-tips"><span>Please check that your listed languages and levels are accurate. You will be able to set any language that is listed as native or C2 as a teaching language. italki uses the Common European Framework of Reference for Languages (CEFR) for displaying language levels.</span>
                        <a target="_blank" rel="noopener noreferrer"
                           href="#"><span>Learn more</span></a>
                    </div>
                    <div class="TeacherApply-form-label"><span>Languages</span></div>
                    <div>
                        <div class="language-skills-row">
                            <div class="menu menu-style-default menu-hide" style="width: 363px; margin-right: 20px;">

                                <select class="ant-input tools-input">
                                    <option>English</option>
                                </select>
                            </div>
                            <div class="menu menu-style-default menu-hide" style="width: 363px;">
                                <select class="ant-input tools-input">
                                    <option>Native speaker</option>
                                </select>

                                <div class="menu-items menu-items-down" style="overflow-y: hidden;">
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">A1: Beginner<br><span id="subtitle"
                                                                                                          class="text-gray3">I just started learning or I can introduce myself and ask simple questions.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">A2: Elementary<br><span
                                                            id="subtitle"
                                                            class="text-gray3">I can describe things in simple terms and understand simple expressions.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">B1: Intermediate<br><span
                                                            id="subtitle"
                                                            class="text-gray3">I can use my language skills when traveling and talk about my hobbies, work, and family.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">B2: Upper Intermediate<br><span
                                                            id="subtitle" class="text-gray3">I can understand the main ideas of a complicated topic and have no trouble talking to native speakers.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">C1: Advanced<br><span id="subtitle"
                                                                                                          class="text-gray3">I can use my language skills in social, academic, or professional situations and keep up with complex conversations.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-24">C2: Proficient<br><span
                                                            id="subtitle"
                                                            class="text-gray3">I can understand almost everything I hear or read and express myself well when talking about complex topics.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <div class="checkmark"></div>
                                            <div>
                                                <div class="ant-row">
                                                    <div class="ant-col ant-col-22">Native speaker<br><span
                                                            id="subtitle"
                                                            class="text-gray3">I grew up speaking this language.</span>
                                                    </div>
                                                    <div class="ant-col ant-col-2 items-center"
                                                         style="display: flex;"><span
                                                            id="checkedIcon"><svg width="24" height="24"
                                                                                  viewBox="0 0 24 24"
                                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                                  fill="#00BFBD"><path
                                                                    fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M18.707 7.793a1 1 0 010 1.414l-7.765 7.765a1 1 0 01-1.414 0l-4.235-4.236a1 1 0 111.414-1.414l3.528 3.529 7.058-7.058a1 1 0 011.414 0z"></path></svg></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-lan-click">+ <span>Add another language</span></div>
                    </div>
                </div>
                <div class="TeacherApply-step-box">
                    <div class="TeacherApply-step-box-title">2.4 <span>My teacher profile photo</span></div>
                    <div class="TeacherApply-upload-avatar-wrapper">
                        <div class="profilePhoto">
                            <div class="profilePhoto-left">
                                <div class="avatar avatar-medium avatar-shadow avatar-placeholder" url=""><img
                                        src="https://scdn.italki.com/orion/static/media/default.d1fa02cb7f0fa0c71a1747badabb9570.svg"
                                        alt="Avatar"></div>
                            </div>
                            <div class="profileEdit-bar photoEdit-bar">
                                <div class="profileEdit-bar-title"><span>Edit Profile Photo</span></div>
                                <ul class="profilePhoto-note">
                                    <li><span>At least 250*250 pixels</span></li>
                                    <li><span>JPG, PNG and BMP formats only</span></li>
                                    <li><span>Maximum size of 2MB</span></li>
                                </ul>
                                <button type="button" class="check-details-btn btn btn-standard btn-ghost-default">
                                    <span>More Requirements</span>
                                </button>
                                <label class="upload-btn"><input type="file"><span>Choose a Photo</span></label></div>
                        </div>
                    </div>
                    <div class="TeacherApply-avatar-requirement-wrapper">
                        <div class="TeacherApply-avatar-requirement-left">
                            <div class="TeacherApply-form-label">Your photo has to respect the following
                                characteristics:
                                *
                            </div>
                            <ul class="TeacherApply-upload-tips">
                                <li><span>does not show other people</span></li>
                                <li><span>is not too close or too far away</span></li>
                                <li><span>shows my eyes and face clearly</span></li>
                                <li><span>is clear and has good lighting</span></li>
                                <li><span>is friendly and personable</span></li>
                            </ul>
                        </div>
                        <div class="TeacherApply-avatar-requirement-right">
                            <div class="TeacherApply-form-label">
                                <span>Does your photo look like these? If so, that's great!</span></div>
                            <div class="TeacherApply-avatar-sample-wrapper"><img class="TeacherApply-avatar-sample"
                                                                                 alt="goodsample"
                                                                                 src="https://scdn.italki.com/orion/static/media/good_sample1.1714d675c98760f04fa5.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="goodsample"
                                    src="https://scdn.italki.com/orion/static/media/good_sample2.40c976a140a5b4761c96.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="goodsample"
                                    src="https://scdn.italki.com/orion/static/media/good_sample3.bcba4c849523d2d85e9d.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="goodsample"
                                    src="https://scdn.italki.com/orion/static/media/good_sample4.e8d65b634de44c427674.jpg">
                            </div>
                            <div class="TeacherApply-form-label"><span>Please<strong> DO NOT </strong>use photos like the ones shown below:</span>
                            </div>
                            <div class="TeacherApply-avatar-sample-wrapper"><img class="TeacherApply-avatar-sample"
                                                                                 alt="badsample"
                                                                                 src="https://scdn.italki.com/orion/static/media/bad_sample1.8843d8575d40ca6e1dcb.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="badsample"
                                    src="https://scdn.italki.com/orion/static/media/bad_sample2.f2fa475a6940daca8ad4.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="badsample"
                                    src="https://scdn.italki.com/orion/static/media/bad_sample3.40a319a8e8b84be7d45e.jpg"><img
                                    class="TeacherApply-avatar-sample" alt="badsample"
                                    src="https://scdn.italki.com/orion/static/media/bad_sample4.32c4c9c4ef8c8b384cd2.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="TeacherApply-upload-checkbox-bar">
                        <div class="TeacherApply-upload-checkbox-wrapper"><label
                                class="TeacherApply-upload-checkbox i-checkbox-wrapper darken"><span
                                    class="i-checkbox"><input type="checkbox" class="i-checkbox-input" value=""><span
                                        class="i-checkbox-inner"></span></span></label>
                            <div class="TeacherApply-upload-checkbox-label"><span>I'm aware that if my profile photo does not respect the listed characteristics, my application to become a teacher on italki could be rejected.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TeacherApply-footer">
                    <button type="button" class="ant-btn ant-btn-default"><span> </span><span>Save for later</span>
                    </button>
                    <button type="submit" class="ant-btn ant-btn-secondary"><span>Next</span></button>
                </div>
            </div>
        </form>
    </div>

@endsection
