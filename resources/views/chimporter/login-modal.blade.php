<div id="loginid-lightbox-container" style="">
	<div id="loginid-lightbox" role="dialog" style="width: 660px; height: 414px;">
		<button id="loginid-close" aria-label="Close Dialog"></button>
		<iframe id="loginid-iframe" name="loginid-iframe" title="" src="" data-view-mode="" scrolling="no" frameborder="0" allowtransparency="true" style="display: block; width: 660px; height: 414px;">
			<body class="page-login">
			    <div id="fb-root"></div>
			    <div id="site-tds-div"></div>
			    <div id="loginid-content" class="content">

			        <header class="loginid-modal-header" role="banner">
			            <div id="loginid-brand-logos">
			                <div id="logo">
			                    <span class="hidden-to-visual">LS Account</span>
			                </div>
			            </div>
			            <div id="secondary-logo">
			            </div>
			        </header>
			        <div id="loginid-page-content" style="position: relative;">
			            <ul id="screenreader-alerts" class="hidden-to-visual screenreader" role="presentation">
			                <li id="sr-a-1" role="alert" data-inuse="false"></li>
			                <li id="sr-a-2" role="alert" data-inuse="false"></li>
			                <li id="sr-a-3" role="alert" data-inuse="false"></li>
			                <li id="sr-a-4" role="alert" data-inuse="false"></li>
			                <li id="sr-a-5" role="alert" data-inuse="false"></li>
			                <li id="sr-a-6" role="alert" data-inuse="false"></li>
			                <li id="sr-a-7" role="alert" data-inuse="false"></li>
			                <li id="sr-a-8" role="alert" data-inuse="false"></li>
			            </ul>
			            <ul id="screenreader-form-errors-1" class="hidden-to-visual screenreader" role="log" aria-atomic="true" data-inuse="false"></ul>
			            <ul id="screenreader-form-errors-2" class="hidden-to-visual screenreader" role="log" aria-atomic="true" data-inuse="false"></ul>
			            <script type="text/javascript" src="/chimporter/javascripts/swlogin/login.js"></script>
			            <div id="loginid-messagediv" class="padmex2 loader" style="display:none;"></div>
			            <div class="login-or-create twocol-container relative full-height" id="login_or_create" data-view-id="login_or_create">
			                <div class="inner twocol-inner-wrapper">
			                    <!-- Normal Login -->
			                    <form id="twdc_form" class="twocol coloredcol align-top" method="post" role="dialog" aria-label="Sign In">
			                        <table class="full-height">
			                            <tbody>
			                                <tr>
			                                    <td>
			                                        <h2>Sign In</h2>
			                                        <h2 class="hide" id="reauth_header">Please sign in to continue.</h2>

			                                        <div class="login" data-validate="required,login" data-revalidate="false">
			                                            <div class="control-group username
			                                                            ">
			                                                <label for="username" class="inline-label">Username or Email Address</label>
			                                                <input type="email" name="username" id="username" class="login-input required" inputmode="email" autocorrect="off" autocapitalize="off" aria-required="true"> </div>

			                                            <div class="control-group password">
			                                                <label for="password" class="inline-label">Password</label>
			                                                <div class="controls">
			                                                    <input type="password" name="password" id="password" class="login-input required" aria-required="true">
			                                                    <div>
			                                                        Forgot your <a id="forgot_username" aria-label="Forgot your  username" href=""><span aria-hidden="true">username</span></a> or <a id="forgot_password" aria-label="Forgot your  password?" href=""><span aria-hidden="true">password?</span></a> </div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                    </td>
			                                </tr>
			                                <tr>
			                                    <td class="alignbottom">
			                                        <div class="full-width">

			                                            <button style="display:inline;" class="btn btn-primary btn-large" type="submit" id="log-in-button">Sign In</button>
			                                        </div>
			                                    </td>
			                                </tr>
			                            </tbody>
			                        </table>

			                    </form>

			                    <!-- Create -->
			                    <form id="twdc_form_create" class="twocol coloredcol align-top" method="get" role="dialog" aria-label="Create Your LS Account">
			                        <input type="hidden" name="page" value="create-profile">
			                        <input type="hidden" name="postMessageOrigin" value="">
			                        <input type="hidden" name="checksum" value="ff283604f4a642a7e64f5f3bcf465db29cf8facb">
			                        <input type="hidden" name="env" value="PROD">
			                        <input type="hidden" name="client_id" value="">
			                        <input type="hidden" name="langPref" value="en-US">
			                        <input type="hidden" name="countryPref" value="">
			                        <input type="hidden" name="continentPref" value="">
			                        <input type="hidden" name="css-override" value="//a.dilcdn.com/sw/disid/inner-override-0de6cda61245.css">
			                        <input type="hidden" name="scheme" value="https">
			                        <input type="hidden" name="responderPage" value="https://a.dilcdn.com/_swdid/">
			                        <input type="hidden" name="successPageAfterCreate" value="true">
			                        <input type="hidden" name="sharedStoragePrefix" value="DIM-STARWARSDOTCOM-PROD">
			                        <input type="hidden" name="onMask" value="960">
			                        <input type="hidden" name="featureMask" value="10">
			                        <input type="hidden" name="postMessageOrigin" value="https://a.dilcdn.com">
			                        <input type="hidden" name="behavior_id" value="DEFAULT">
			                        <table class="full-height">
			                            <tbody>
			                                <tr>
			                                    <td class="align-top" style="position:relative;">
			                                        <h2>Create Your LS Account</h2>
			                                        <div>
			                                            <p id="signup-pitch" class="value">
			                                                Get access to this and other <strong>LS sites!</strong>
			                                            </p>
			                                        </div>
			                                        <fieldset id="birthdate" class="birthdate">
			                                            <label>Birth Date</label>
			                                            <div class="controls control-group hideonanyclick" id="dob-select">
			                                                <div class="birthdate-month left">
			                                                    <label class="hide" for="birthdate-month">Birth Month</label>
			                                                    <div class="controls">
			                                                        <select class="colored required" aria-required="true" id="birthdate-month" name="birthdate-month" aria-label="Birth Month">
			                                                            <option value="">Month</option>
			                                                            <option value="01">January</option>
			                                                            <option value="02">February</option>
			                                                            <option value="03">March</option>
			                                                            <option value="04">April</option>
			                                                            <option value="05">May</option>
			                                                            <option value="06">June</option>
			                                                            <option value="07">July</option>
			                                                            <option value="08">August</option>
			                                                            <option value="09">September</option>
			                                                            <option value="10">October</option>
			                                                            <option value="11">November</option>
			                                                            <option value="12">December</option>
			                                                        </select>
			                                                    </div>
			                                                </div>
			                                                <div class="birthdate-day left padleft5">
			                                                    <label class="hide" for="birthdate-day">Birth Day</label>
			                                                    <div class="controls">
			                                                        <select class="colored required" aria-required="true" id="birthdate-day" name="birthdate-day" aria-label="Birth Day">
			                                                            <option value="">Day</option>
			                                                            <option value="01">1</option>
			                                                            <option value="02">2</option>
			                                                            <option value="03">3</option>
			                                                            <option value="04">4</option>
			                                                            <option value="05">5</option>
			                                                            <option value="06">6</option>
			                                                            <option value="07">7</option>
			                                                            <option value="08">8</option>
			                                                            <option value="09">9</option>
			                                                            <option value="10">10</option>
			                                                            <option value="11">11</option>
			                                                            <option value="12">12</option>
			                                                            <option value="13">13</option>
			                                                            <option value="14">14</option>
			                                                            <option value="15">15</option>
			                                                            <option value="16">16</option>
			                                                            <option value="17">17</option>
			                                                            <option value="18">18</option>
			                                                            <option value="19">19</option>
			                                                            <option value="20">20</option>
			                                                            <option value="21">21</option>
			                                                            <option value="22">22</option>
			                                                            <option value="23">23</option>
			                                                            <option value="24">24</option>
			                                                            <option value="25">25</option>
			                                                            <option value="26">26</option>
			                                                            <option value="27">27</option>
			                                                            <option value="28">28</option>
			                                                            <option value="29">29</option>
			                                                            <option value="30">30</option>
			                                                            <option value="31">31</option>
			                                                        </select>
			                                                    </div>
			                                                </div>
			                                                <div class="birthdate-year left padleft5">
			                                                    <label class="hide" for="birthdate-year">Birth Year</label>
			                                                    <div class="controls">
			                                                        <select class="colored required" aria-required="true" id="birthdate-year" name="birthdate-year" data-selected="" aria-label="Birth Year">
			                                                            <option value="">Year</option>
			                                                            <option value="2015">2015</option>
			                                                            <option value="2014">2014</option>
			                                                        </select>
			                                                    </div>
			                                                </div>
			                                                <div class="clear"></div>
			                                            </div>
			                                            <div class="controls control-group hideonanyclick" id="dob-locked">
			                                                <input type="text" id="dateOfBirth" name="dateOfBirth" disabled="disabled" class="required" value="1970-01-01">
			                                                <input type="hidden" name="birthdate-year" value="1970" disabled="disabled">
			                                                <input type="hidden" name="birthdate-month" value="01" disabled="disabled">
			                                                <input type="hidden" name="birthdate-day" value="01" disabled="disabled">
			                                                <div class="clear"></div>
			                                            </div>
			                                        </fieldset>
			                                    </td>
			                                </tr>

			                                <tr>
			                                    <td class="align-bottom">
			                                        <button class="btn btn-primary btn-large" type="submit" id="create-account-from-login" onclick="Accessibility.validation.clearForm('twdc_form_create');return checkDateOfBirth(event);">Continue</button>
			                                        <div class="hidden-to-visual" style="bottom:0">
			                                            <button class="accessibility-close-dialog" type="button">Close Dialog</button>
			                                        </div>
			                                        <script type="text/javascript">
			                                            $(".accessibility-close-dialog").on("click", function(e) {
			                                                e.preventDefault();
			                                                LoginID.postMessageTransport.send("closeTopIFrame");
			                                            });
			                                        </script>
			                                    </td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </form>
			                    <!-- end Create -->
			                    <form id="dobform" style="display:none;"></form>
			                    <!-- placeholder for missing DOB -->
			                </div>
			                <!-- end innerwrapper -->
			            </div>
			            <!-- end login-or-create div -->



			        </div>
			        <script type="text/javascript">
			            $(function() {
			                loadPageValueProp();

			                // If third-party localstorage is disabled redirect to error page
			                if (LoginID.thirdPartyCookiesDisabled) {
			                    var page = "login",
			                        whiteList = ['cookies-disabled', 'silentlogin', 'silent-client-functions', 'recover-password', 'forgot-username-password', '500', '404', '403'];
			                    if ($.inArray(page, whiteList) === -1) {
			                        LoginID.log("Error: third party cookies are disabled!");
			                        //redirect to error message
			                        LoginID.navigate('cookies-disabled', {
			                            queryUpsert: {
			                                referer: document.location.href
			                            }
			                        });
			                        return;
			                    } else {
			                        LoginID.log("Third party cookies are disabled, but page is whitelisted so things should be a-ok.", page);
			                    }
			                }
			            });


			            if (LoginID && typeof LoginID.pageJS === 'function') {
			                $(LoginID.pageJS);
			            }

			            $(function() {
			                window.utag_data.sequence = '0';
			                doTealium();
			                LoginID.resizeLightbox(660);
			            });

			            //to dynamically update tealium,
			            //  utag.link({"form_name":"registration", flow_name":"fb", "field_name":'[lastName,firstName,...,terms]'})
			        </script>
			    </div>
			    <!-- Close #LoginID-page-content -->
			</body>
		</iframe>
		<div class="loginid-clear"></div>
	</div>
</div>