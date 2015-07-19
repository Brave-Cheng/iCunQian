[Canada Issue 2611](https://mantis.commer.com/view.php?id=25925)
----

#Usage

```bash
find -name '*.tpl' |xargs fgrep 'email_signup'
```
#Search included templates

```search
find in folder on sublime.(eg:  'mailinglist_subscribe')
```




#*Site Lists*
----







#[1、bannockburn(54)](http://www.bannockburn.ca/)
    
####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/bannockburn

####Templates
>
+   templates/mailinglist_subscribe.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="44" action=action}
+   templates/en/mailinglist_subscribe.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="44" action=action}

####Pages
+   http://www.bannockburn.ca/forms/contact_form-f9

####Validate

1.  "Your first name" and "Your last name" 不能为空!
2.  "Your e-mail address" 必须是email！
3.  如果email与siteid存在（mail_subscriber）,则不能再次订阅。

4.  订阅成功，则返回“Thanks for subscribing!”







#[2、ccaa(122) -- (Canadian Collegiate Athletic Association)](http://www.ccaa.ca/)

+   http://leaguestat.rapidmanager.com/

####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/ccaa

####Templates
>
    fgrep: ./templates/40th: No such file or directory
    fgrep: Anniversary.tpl: No such file or directory
    fgrep: ./templates/40th: No such file or directory
    fgrep: Sidebar.tpl: No such file or directory
    fgrep: ./templates/fr/40th: No such file or directory
    fgrep: Anniversary.tpl: No such file or directory
    fgrep: ./templates/fr/40th: No such file or directory
    fgrep: Sidebar.tpl: No such file or directory

####Page
未发现调用页面

<!-- +   188257(40th Anniversary.tpl) 
>+   http://www.ccaa.ca/timeline-p188257-preview-1  -->





#[3、commer(72)](http://www.commer.com/)

####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/commer

####Tempates
>   
+   ./templates/subscriber_register.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" prefix="prefix" mail_list_id="107" action=action styleid="type" langeng="lang_en" langfr="lang_fr"}

####Pages
+   http://www.commer.com/index.php?t=subscriber_register&preview=1
####Validate
1.  "Your email" 不能为空!

2.  "Your email" 验证格式是否是email
3.  如果email与siteid存在（mail_subscriber）,提示“Email is existed in the database, please try another email.”
4.  成功返回"Register successfully."
5.  验证自定义字段规则







#[4、coyotes(79) -- (South Central Ontario Coyotes)](http://www.richmondhillcoyotes.com)
    
####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/coyotes

####Tempates
>   
+   ./templates/en/sidebar.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="145" action=action}
+   ./templates/en/newsletter.tpl:{email_signup formvar="f_email" mail_list_id="145" action=action}
+   fgrep: ./templates/en/calendar: No such file or directory
+   fgrep: page.tpl: No such file or directory
+   ./templates/newsletter.tpl:{email_signup formvar="f_email" mail_list_id="145" action=action}
+   fgrep: ./templates/calendar: No such file or directory
+   fgrep: page.tpl: No such file or directory

####Page
+   136485(newsletter.tpl)
>+  http://www.richmondhillcoyotes.com/subscription-management-p136485-preview-1


####Validate
1.  验证Email不能为空！
2.  验证Email格式是否正确！
3.  验证Email是否已经订阅！
4.  订阅成功返回“Thanks for signing up for the Coyotes Newsletter!”









#[5、medion(69)](http://www.eload.net)

####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/medion

####Tempates
>
+   ./templates/signup.tpl:{email_signup formvar="emailSignup" action=action}
+   ./templates/en/signup.tpl:{email_signup formvar="emailSignup" action=action}


####Page

+	未发现调用页面
+	订阅模板 => http://www.eload.net/index.php?t=signup.tpl


<!-- +   136104
>+  http://www.eload.net/welcome-p136104-preview-1
+   155499
>+  http://www.eload.net/ambassadors-list-p155499-preview-1
 -->






#[6、str(26) -- (Share The Road)](http://www.sharetheroad.ca)

####Web Root
>   /home/httpd/html/rapidmanager/frontend/sites/str

####Tempates

+   ./templates/newsletter_new.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}
+   ./templates/en/footer.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}
+   ./templates/en/newsletter.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}
+   ./templates/footer.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}
+   ./templates/foot.tpl:           {email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}
+   ./templates/newsletter.tpl:{email_signup formvar="f_email" fname="f_fname" lname="f_lname" mail_list_id="43" action=action}

####Page
+   135766(newsletter_new.tpl)
>+  http://www.sharetheroad.ca/share-the-road-newsletter-p135766-preview-1
+   153111(newsletter.tpl)
>+   http://www.sharetheroad.ca/share-the-road-newsletter-may-2010-p153111-preview-1
+   142968(newsletter.tpl)
>+  http://www.sharetheroad.ca/share-the-road-newsletter-march-2012-p142968-preview-1

####Validate
1.  验证Email不能为空！
2.  验证Email格式是否正确！
3.  验证Email是否已经订阅！
4.  订阅成功返回“Thanks for subscribing to the Share The Road Newsletter!”