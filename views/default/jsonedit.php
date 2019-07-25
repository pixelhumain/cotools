<?php 

$cssJS = array(

    '/plugins/jsoneditoronline/jsoneditor-min.js',
    '/plugins/jsoneditoronline/jsoneditor.css',
);
HtmlHelper::registerCssAndScriptsFiles($cssJS, Yii::app()->request->baseUrl);
?>

<?php $costums = PHDB::find("costum"); ?>
    <select id="jsonChoose">
        <?php foreach ($costums as $key => $value) {
            if(isset($value["slug"])){
                $sel = ($value["slug"] == $_GET["attr"]) ? : "";
                echo "<option $sel value='".$value["slug"]."'>".$value["slug"]."</option>";
            }
        } ?>
    </select>
    <button onclick="setJSON();">Set JSON</button>
    <button onclick="getJSON();">Get JSON</button>
    <?php if(Yii::app()->session["userId"] && isset($json["admins"]) && in_array(Yii::app()->session["userId"], $json["admins"] ) ) { ?>
        <button onclick="save();">Save JSON</button>
    <?php } else { ?>
        <button onclick="saveAs();">Save a copy </button>
    <?php } ?>
  


  <?php //var_dump($json); ?>
  <div id="jsoneditor" style="width: 100%;"></div>
  


  
<script type="text/javascript" >
var editor = null;
var json = <?php echo json_encode($json) ?>;
$(document).ready(function() { 
    // create the editor
    var container = document.getElementById("jsoneditor");
    editor = new JSONEditor(container);
    editor.set(json);
    $('#jsonChoose').change(function() {
        window.location = "http://127.0.0.1/ph/cotools/default/jsonedit/col/costum/attr/slug/val/" + $(this).val();
    });
});

// set json
function setJSON () {
  var json = {
    "Array": [1, 2, 3],
    "Boolean": true, 
    "Null": null, 
    "Number": 123, 
    "Object": {"a": "b", "c": "d"},
    "String": "Hello World"
  };
  editor.set(json);
}

// get json
function getJSON() {
  var json = editor.get();
  alert(JSON.stringify(json, null, 2));
}

</script>