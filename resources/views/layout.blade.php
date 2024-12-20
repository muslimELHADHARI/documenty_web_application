<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Custom auth laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    @include('include.header')
    @yield('content')
    @include('include.footer')
<div id="google_translate_element"></div>
<!-- Google Translate Script -->
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', // Set your default language
            includedLanguages: 'en,es,fr,de,it,ar', // Languages you want to support
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- Custom Styles for the Google Translate Widget -->
<style>
    /* Styling the Google Translate container */
    #google_translate_element {
        position: relative;
        display: inline-block;
        margin: 10px 0;
        font-family: Arial, sans-serif;
    }

    /* Styling the select dropdown inside the Google Translate widget */
    .goog-te-combo {
        width: 200px;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    /* Adding hover effect on dropdown */
    .goog-te-combo:hover {
        border-color: #4CAF50;
        box-shadow: 0 2px 8px rgba(0, 172, 93, 0.3);
    }

    /* Adding focus effect on dropdown */
    .goog-te-combo:focus {
        border-color: #4CAF50;
        outline: none;
        box-shadow: 0 0 10px rgba(0, 172, 93, 0.3);
    }

    /* Adjusting the dropdown arrow */
    .goog-te-combo option {
        font-size: 14px;
    }

    /* Positioning and customizing the text */
    .goog-te-menu-value {
        font-size: 14px;
        color: #555;
    }

    /* Styling for the drop-down background */
    .goog-te-menu {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Customizing the hover effect for the language options */
    .goog-te-menu2-item {
        padding: 8px;
        cursor: pointer;
    }

    .goog-te-menu2-item:hover {
        background-color: #f1f1f1;
    }

    /* Optional: Center the translation dropdown in your page */
    .google-translate-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }
</style>
<!--Yo Bro-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/67547def4304e3196aee63f9/1ieh0ns6a';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->  </body>
</html>