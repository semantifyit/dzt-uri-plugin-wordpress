(function( $ ) {
	'use strict';

	$( window ).load(function() {
        loadDZTURI();
    });

    var dztApiUrl = 'http://localhost:8080/api/entities';

    /*var sampleAnn = { // TODO REMOVE
        "@context": "http://schema.org/",
        "@type": "TouristAttraction",
        "name": "goldenes dachl",
        "address": {
          "@type": "PostalAddress",
          "addressCountry": "österreich",
          "postalCode": "6020",
          "addressLocality": "innsbruck",
          "streetAddress": "maria"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": "47.267764",
          "longitude": "11.403858"
        }
      };*/

    function loadDZTURI() {
        document.getElementById('sem-dzt-uri-ds-select').addEventListener('change', function() {
            document.getElementById('sem-dzt-uri-ds-add').disabled = this.value === '';
        })
        document.getElementById('sem-dzt-uri-ds-add').addEventListener('click', function() {
            var val = document.getElementById('sem-dzt-uri-ds-select').value;

            var saveButton = {
                name: "Get-URI",
                icon: "done",
                createJsonLD: true,
                onclick: function (res) {
                    console.log('click');
                    console.log(res);
                    if(!res.jsonLd) {
                        return;
                    }
                    var body = {annotation: res.jsonLd};

                    // show modal
                    showSuccessModal(res.jsonLd);

                    try {
                        // throw new Error("Ooops")
                        InstantAnnotation.util.httpPostJson(dztApiUrl, undefined, body, function(dztRes) {
                            if(dztRes && dztRes.data && dztRes.msg === 'OK' && dztRes.data.uri) {
                                var uri = dztRes.data.uri;
                                finishSuccessModal(uri);
                            } else {
                                finishSuccessModal("Something went wrong", true);
                            }
                        });
                    } catch (e) {
                        finishSuccessModal(e.toString(), true);
                    }
                },
            };
            var options = {
                panelColClass: "col-md-4",
                withSubClassSelection: false,
                buttons: ['preview', saveButton],
                //annotation: sampleAnn, // TODO REMOVE
            };

            InstantAnnotation.createIABox('sem-dzt-uri-ia-boxes', val, options)
            console.log(val);
        })
    }

    function showSuccessModal(annotation) {
        var dummy = document.createElement("div");
        document.body.appendChild(dummy);
        dummy.setAttribute("id", "sem-dzt-uri-modal-outer");

        document.getElementById('sem-dzt-uri-modal-outer').innerHTML =
            '<div class="bootstrap semantify semantify-instant-annotations">' +
            '<div class="modal fade" id="sem-dzt-uri-modal" role="dialog">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">DZT URI Analysis</h4>' +
            '</div>' +
            '<div id="sem-dzt-uri-modal-body" class="modal-body">' +
            '<div id="sem-dzt-uri-modal-result" style="display:none; margin-bottom:3rem">' +
            '<h5>Successfully analyzed annotation!<br/><br/>Uri: <span id="sem-dzt-uri-modal-result-uri" style="word-break:break-all; font-weight:bold"></span></h5>' +
            '</div>' +
            '<div id="sem-dzt-uri-modal-error" style="display:none; margin-bottom:3rem">' +
            '<h5>Some error happened: <br/><span id="sem-dzt-uri-modal-error-str" style="word-break:break-all"></span></h5>' +
            '</div>' +
            '<div id="sem-dzt-uri-modal-loading">' +
            'Waiting for results...' +
            '<br/>' +
            '<img id="loading_import_annotations" src="https://semantify.it/images/loading.gif"> ' +
            '</div>' +
            '<pre id="sem-dzt-uri-modal-pre" style="max-height: 500px;"></pre>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#sem-dzt-uri-modal')
            .modal()
            .on('hidden.bs.modal', function () {
                $(this).remove();
            });

        document.getElementById('sem-dzt-uri-modal-loading').style.display = 'block';
        document.getElementById('sem-dzt-uri-modal-pre').innerHTML = InstantAnnotation.util.syntaxHighlight(JSON.stringify(annotation, null, 2));
    }

    function finishSuccessModal(msg, error){
        document.getElementById('sem-dzt-uri-modal-loading').style.display = 'none';
        if (error === true) {
            document.getElementById('sem-dzt-uri-modal-error').style.display = 'block';
            document.getElementById('sem-dzt-uri-modal-error-str').innerHTML = msg;
            document.getElementById('sem-dzt-uri-modal-pre').style.display = 'none';
        } else {
            document.getElementById('sem-dzt-uri-modal-result').style.display = 'block';
            document.getElementById('sem-dzt-uri-modal-result-uri').innerHTML = msg;
        }
    }

})( jQuery );
