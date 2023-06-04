<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</head>
  <body>

   <iframe  id="docx" name="docx" src="modelelettre1.docx"></iframe>

 <button class="btn btn-light" onclick="printt()">imprimer</button>

 <script type="text/javascript">
   function printt()
{
  var pdfFrame = window.frames["docx"];
  //pdfFrame.focus();
  pdfFrame.print();
}
 </script>
  
  </body>
</html>