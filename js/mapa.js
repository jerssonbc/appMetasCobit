
  function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
      $(go.Diagram, "myDiagram",  // must name or refer to the DIV HTML element
        {
          initialContentAlignment: go.Spot.Center,
          allowDrop: true,  // must be true to accept drops from the Palette
          "LinkDrawn": showLinkLabel,  // this DiagramEvent listener is defined below
          "LinkRelinked": showLinkLabel,
          "animationManager.duration": 800, // slightly longer than default (600ms) animation
          "undoManager.isEnabled": true  // enable undo & redo
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });

    // helper definitions for node templates

    function nodeStyle() {
      return [
        // The Node.location comes from the "loc" property of the node data,
        // converted by the Point.parse static method.
        // If the Node.location is changed, it updates the "loc" property of the node data,
        // converting back using the Point.stringify static method.
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
          // the Node.location is at the center of each node
          locationSpot: go.Spot.Center,
          //isShadowed: true,
          //shadowColor: "#888",
          // handle mouse enter/leave events to show/hide the ports
          mouseEnter: function (e, obj) { showPorts(obj.part, true); },
          mouseLeave: function (e, obj) { showPorts(obj.part, false); }
        }
      ];
    }

    // Define a function for creating a "port" that is normally transparent.
    // The "name" is used as the GraphObject.portId, the "spot" is used to control how links connect
    // and where the port is positioned on the node, and the boolean "output" and "input" arguments
    // control whether the user can draw links from or to the port.
    function makePort(name, spot, output, input) {
      // the port is basically just a small circle that has a white stroke when it is made visible
      return $(go.Shape, "Circle",
               {
                  fill: "transparent",
                  stroke: null,  // this is changed to "white" in the showPorts function
                  desiredSize: new go.Size(8, 8),
                  alignment: spot, alignmentFocus: spot,  // align the port on the main Shape
                  portId: name,  // declare this object to be a "port"
                  fromSpot: spot, toSpot: spot,  // declare where links may connect at this port
                  fromLinkable: output, toLinkable: input,  // declare whether the user may draw links to/from here
                  cursor: "pointer"  // show a different cursor to indicate potential link point
               });
    }

    // define the Node templates for regular nodes

    var lightText = 'whitesmoke';

    myDiagram.nodeTemplateMap.add("Estrategicos",  // the default category
      $(go.Node, "Spot", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#c62828", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, false, true),
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, true, false)
      ));
    myDiagram.nodeTemplateMap.add("Primario",  // the default category
      $(go.Node, "Spot",{ resizable: true }, nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#388e3c", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, true, true),
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, true, true)
      ));
    myDiagram.nodeTemplateMap.add("Apoyo",  // the default category
      $(go.Node, "Spot", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#00A9C9", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, false, true),
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, true, false)
      ));

    myDiagram.nodeTemplateMap.add("Start",
      $(go.Node, "Spot", nodeStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { maxSize: new go.Size(40, 400),minSize: new go.Size(40, 400), fill: "#79C900", stroke: null }),
          $(go.TextBlock, "R\nE\nQ\nU\nE\nR\nI\nM\nI\nE\nN\nT\nO\n \nD\nE\nL\n \nC\nL\nI\nE\nN\nT\nE",
            { margin: 5, font: "bold 9pt Helvetica, Arial, sans-serif", stroke: lightText })
        ),
        // three named ports, one on each side except the top, all output only:
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true),
        makePort("T", go.Spot.Top, true, false)
      ));

    myDiagram.nodeTemplateMap.add("End",
      $(go.Node, "Spot", nodeStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { maxSize: new go.Size(40, 400),minSize: new go.Size(40, 400),  fill: "#DC3C00", stroke: null }),
          $(go.TextBlock, "S\nA\nT\nI\nS\nF\nA\nC\nC\nI\nO\nN\n \nD\nE\nL\n \nC\nL\nI\nE\nN\nT\nE\n",
            { margin: 5, font: "bold 11pt Helvetica, Arial, sans-serif", stroke: lightText })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, true,false),
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true)
      ));
    myDiagram.nodeTemplateMap.add("ContenedorPrimario",
      $(go.Node, "Spot", nodeStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 300), fill: "#c8e6c9", stroke: null }),
          $(go.TextBlock, "Procesos Primarios",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false)
      ));
    myDiagram.nodeTemplateMap.add("ContenedorApoyo",
      $(go.Node, "Spot", nodeStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 150), fill: "#81d4fa", stroke: null }),
          $(go.TextBlock, "Procesos Apoyo",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false)
      ));
    myDiagram.nodeTemplateMap.add("ContenedorEstrategico",
      $(go.Node, "Spot", nodeStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 150), fill: "#ef9a9a", stroke: null }),
          $(go.TextBlock, "Procesos Estrategicos",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, true),
        makePort("R", go.Spot.Right, false, true)
      ));

    myDiagram.nodeTemplateMap.add("Comment",
      $(go.Node, "Auto", nodeStyle(),
        $(go.Shape, "File",
          { fill: "#EFFAB4", stroke: null }),
        $(go.TextBlock,
          {
            margin: 5,
            maxSize: new go.Size(200, NaN),
            wrap: go.TextBlock.WrapFit,
            textAlign: "center",
            editable: true,
            font: "bold 12pt Helvetica, Arial, sans-serif",
            stroke: '#454545'
          },
          new go.Binding("text", "text").makeTwoWay())
        // no ports, because no links are allowed to connect with a comment
      ));

    myDiagram.groupTemplate =
    $(go.Group, "Vertical",
      { selectionObjectName: "PH",
        locationObjectName: "PH",
        resizable: true,
        resizeObjectName: "PH" },
      new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
      $(go.TextBlock,  // group title
        { font: "Bold 12pt Sans-Serif" },
        new go.Binding("text", "key")),
      $(go.Shape,  // using a Shape instead of a Placeholder
        { name: "PH",
          fill: "lightyellow" },
        new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify))
    );
    function highlightGroup(e, grp, show) {
              if (!grp) return;
              e.handled = true;
              if (show) {
                  // cannot depend on the grp.diagram.selection in the case of external drag-and-drops;
                  // instead depend on the DraggingTool.draggedParts or .copiedParts
                  var tool = grp.diagram.toolManager.draggingTool;
                  var map = tool.draggedParts || tool.copiedParts;  // this is a Map
                  // now we can check to see if the Group will accept membership of the dragged Parts
                  if (grp.canAddMembers(map.toKeySet())) {
                      grp.isHighlighted = true;
                      return;
                  }
              }
              grp.isHighlighted = false;
   }

  function finishDrop(e, grp) {
              var ok = grp !== null && grp.addMembers(grp.diagram.selection, true);
              if (!ok) grp.diagram.currentTool.doCancel();
  }
    myDiagram.groupTemplateMap.add("MacroProceso",
            $(go.Group, go.Panel.Auto,
              {
                  background: "transparent",

                  // highlight when dragging into the Group
                  mouseDragEnter: function(e, grp, prev) { highlightGroup(e, grp, true); },
                  mouseDragLeave: function(e, grp, next) { highlightGroup(e, grp, false); },
                  computesBoundsAfterDrag: true,
                  // when the selection is dropped into a Group, add the selected Parts into that Group;
                  // if it fails, cancel the tool, rolling back any changes
                  mouseDrop: finishDrop,
                  // Groups containing Groups lay out their members horizontally
                  layout:
                    $(go.GridLayout,
                      { wrappingWidth: 1, alignment: go.GridLayout.Position,
                          cellSize: new go.Size(1, 1), spacing: new go.Size(4, 14) })
              },
              $(go.Panel, go.Panel.Vertical,
                $(go.Panel, go.Panel.Horizontal,
                  { stretch: go.GraphObject.Horizontal, background: "#33D3E5" },
                  $("SubGraphExpanderButton",
                    { alignment: go.Spot.Right, margin: 5 }),
                  $(go.TextBlock,
                    { alignment: go.Spot.Left, editable: true,
                        margin: 5,
                        font: "bold 18px sans-serif",
                        stroke: "#9A6600"
                    },
                    new go.Binding("text", "text").makeTwoWay())
                ),  // end Horizontal Panel
                $(go.Placeholder,
                  { padding: 5, alignment: go.Spot.TopLeft },
                  new go.Binding("background", "isHighlighted", function(h) { return h ? "red": "transparent"; }).ofObject())
              ),  // end Vertical Panel
              $(go.Shape, "Rectangle",
                {
                    isPanelMain: true,  // the Rectangle Shape is in front of the Vertical Panel
                    fill: null,
                    stroke: "#E69900",
                    strokeWidth: 2,
                })
              )); 



    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        {
          routing: go.Link.AvoidsNodes,
          curve: go.Link.JumpOver,
          corner: 5, toShortLength: 4,
          relinkableFrom: true,
          relinkableTo: true,
          reshapable: true
        },
        new go.Binding("points").makeTwoWay(),
        $(go.Shape,  // the link path shape
          { isPanelMain: true, stroke: "gray", strokeWidth: 2 }),
        $(go.Shape,  // the arrowhead
          { toArrow: "standard", stroke: null, fill: "gray"}),
        $(go.Panel, "Auto",  // the link label, normally not visible
          { visible: false, name: "LABEL", segmentIndex: 2, segmentFraction: 0.5},
          new go.Binding("visible", "visible").makeTwoWay(),
          $(go.Shape, "RoundedRectangle",  // the label shape
            { fill: "#F8F8F8", stroke: null }),
          $(go.TextBlock, "Yes",  // the label
            {
              textAlign: "center",
              font: "10pt helvetica, arial, sans-serif",
              stroke: "#333333",
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay())
        )
      );

    // Make link labels visible if coming out of a "conditional" node.
    // This listener is called by the "LinkDrawn" and "LinkRelinked" DiagramEvents.
    function showLinkLabel(e) {
      var label = e.subject.findObject("LABEL");
      if (label !== null) label.visible = (e.subject.fromNode.data.figure === "Diamond");
    }

    // temporary links used by LinkingTool and RelinkingTool are also orthogonal:
    myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
    myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;

    load();  // load an initial diagram from some JSON text

    // initialize the Palette that is on the left side of the page
    myPalette =
      $(go.Palette, "myPalette",  // must name or refer to the DIV HTML element
        {
          "animationManager.duration": 800, // slightly longer than default (600ms) animation
          nodeTemplateMap: myDiagram.nodeTemplateMap,
          groupTemplateMap: myDiagram.groupTemplateMap,  // share the templates used by myDiagram
          model: new go.GraphLinksModel([  // specify the contents of the Palette
            { category: "Estrategicos", text: "Estrategico" },
            { category: "Primario", text: "Primario" },
            { category: "Apoyo", text: "Apoyo" },
            { category: "MacroProceso", text: "MP",isGroup:true},
            { category: "Comment", text: "Comment", figure: "RoundedRectangle" }
          ])
        });
  }

  // Make all ports on a node visible when the mouse is over the node
  function showPorts(node, show) {
    var diagram = node.diagram;
    if (!diagram || diagram.isReadOnly || !diagram.allowLink) return;
    node.ports.each(function(port) {
        port.stroke = (show ? "white" : null);
      });
  }


  // Show the diagram's model in JSON format that the user may edit
  function save() {

    mySavedModel=myDiagram.model.toJson();
    myDiagram.isModified = false;
    //alert(mySavedModel);
        $.ajax({
            type: "POST",
            data: {mySavedModel,Guardar:'grabar',param_opcion:'grabar'},
            url: "control/controlProcesos.php",
            success: function(datos) {
                if (datos == '') {
                    document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                    myDiagram.isModified = false;
                } else {
                    location.reload();
                }
            },
            error: function(datos) {
                document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                myDiagram.isModified = false;
            }
     });   
      
  }
  function load() {

    mySavedModel=$('#mySavedModel').val();
    myDiagram.model = go.Model.fromJson(mySavedModel);
        $.ajax({
            type: "POST",
            data: {mySavedModel,Cargar:'Cargar',param_opcion:'Cargar'},
            url: "control/controlProcesos.php",
            success: function(datos) {
                if (datos =='Error') {
                    
                } else {
                    myDiagram.model = go.Model.fromJson(datos);
                }
            },
            error: function(datos) {
                
            }
        });
    
  }

  // add an SVG rendering of the diagram at the end of this page
  function makeSVG() {
    var svg = myDiagram.makeSvg({
        scale: 0.5
      });
    svg.style.border = "1px solid black";
    obj = document.getElementById("SVGArea");
    obj.appendChild(svg);
    if (obj.children.length > 0) 
      obj.replaceChild(svg, obj.children[0]);
  }
  function guardarImages(){

    var img = new Image();
    var img = document.getElementsByClassName('images')[0];

    //alert(img.getAttribute('src')); // foo.jpg
    //var url = img.src.replace(/^data:image\/[^;]/, 'data:image/jpeg');
    //window.open(url);
   
    // atob to base64_decode the data-URI
    var image_data = atob(img.src.split(',')[1]);
    // Use typed arrays to convert the binary data to a Blob
    var arraybuffer = new ArrayBuffer(image_data.length);
    var view = new Uint8Array(arraybuffer);
    for (var i=0; i<image_data.length; i++) {
        view[i] = image_data.charCodeAt(i) & 0xff;
    }
    try {
        // This is the recommended method:
        var blob = new Blob([arraybuffer], {type: 'image/jpeg'});
    } catch (e) {
        // The BlobBuilder API has been deprecated in favour of Blob, but older
        // browsers don't know about the Blob constructor
        // IE10 also supports BlobBuilder, but since the `Blob` constructor
        //  also works, there's no need to add `MSBlobBuilder`.
        var bb = new (window.WebKitBlobBuilder || window.MozBlobBuilder);
        bb.append(arraybuffer);
        var blob = bb.getBlob('image/jpeg'); // <-- Here's the Blob
    }

    // Use the URL object to create a temporary URL
    var url = (window.webkitURL || window.URL).createObjectURL(blob);
    window.open(url); // <-- Download!


  }
  function generateImages() {
      // sanitize input
      var width=1000;
      var height=700;
      width = parseInt(width);
      height = parseInt(height);
      if (isNaN(width)) width = 100;
      if (isNaN(height)) height = 100;
      // Give a minimum size of 50x50
      width = Math.max(width, 50);
      height = Math.max(height, 50);



      var imgDiv = document.getElementById('myImages');
      imgDiv.innerHTML = ''; // clear out the old images, if any
      var db = myDiagram.documentBounds.copy();
      var boundswidth = db.width;
      var boundsheight = db.height;
      var imgWidth = width;
      var imgHeight = height;
      var p = db.position.copy();
      for (var i = 0; i < boundsheight; i += imgHeight) {
        for (var j = 0; j < boundswidth; j += imgWidth) {
          img = myDiagram.makeImage({
            scale: 1,
            position: new go.Point(p.x + j, p.y + i),
            size: new go.Size(imgWidth, imgHeight)
          });
          // Append the new HTMLImageElement to the #myImages div
          img.className = 'images';
          imgDiv.appendChild(img);
          imgDiv.appendChild(document.createElement('br'));
        }
      }
    }

    var button = document.getElementById('makeImages');
    button.addEventListener('click', function() {
      var width = parseInt(document.getElementById('widthInput').value);
      var height = parseInt(document.getElementById('heightInput').value);
      generateImages(width, height);
    }, false);

    // Call it with some default values
    generateImages(700, 960);

