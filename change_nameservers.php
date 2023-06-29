<?php



?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
var url = 'https://api.godaddy.com/v1/domains/<?php echo $_GET["domain"]; ?>/records';
 $.ajax({
  type: 'PUT',
  url: url,
  data: {
  'domain': '<?php echo $_GET['domain']; ?>',
    'records': [{
       'type': 'NS',
       'name': '<?php echo $_GET['ns1']; ?>',
       'data': '64.71.74.33',
       'ttl' : '3600'
    }]
  },
  headers: {
    'Authorization': 'sso-key <?php echo $_GET["API"]; ?>:<?php echo $_GET["SECRET"]; ?>'
  },
  success: function(body) {
    console.log(body);
  }
});
</script>
