<!DOCTYPE html>
<html lang=en>
<head>
  <meta charset=utf-8>
  <title>Testing a PayPal Payments Standard Button</title>
</head>
<body>
<h2>Buy Strings!</h2>
<table>
<tr>
  <td>Bass Guitar Strings</td>
  <td>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="6RNT8A4HBBJRE">
      <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
  </td>
</tr>
</table>
</body>
</html>