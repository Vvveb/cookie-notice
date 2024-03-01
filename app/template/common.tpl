#cookie-notice|delete

head|append = from(/public/plugins/cookie-notice/notice.html|body > style)
body|append = from(/public/plugins/cookie-notice/notice.html|body > #cookie-notice)
body|append = from(/public/plugins/cookie-notice/notice.html|body > #cookie-notice-js)

//don't show the cookie notice if page is edited
#cookie-notice|hide    = $vvveb_is_page_edit
#cookie-notice-js|hide = $vvveb_is_page_edit
