#cookie-notice|delete

head|append = from(/public/plugins/cookie-notice/notice.html|body > style)
body|append = from(/public/plugins/cookie-notice/notice.html|body > #cookie-notice)
body|append = from(/public/plugins/cookie-notice/notice.html|body > #cookie-notice-js)

//don't show the cookie notice if page is edited
#cookie-notice|hide    = $is_editor
#cookie-notice-js|hide = $is_editor
