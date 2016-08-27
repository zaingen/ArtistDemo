<?php $__env->startPush('css'); ?>
 <style>
    #search-form, .form-control {
        margin-bottom: 20px;
    }
    .cover {
        width: 300px;
        height: 300px;
        display: inline-block;
        background-size: cover;
    }
    .cover:hover {
        cursor: pointer;
    }
    .cover.playing {
        border: 5px solid #e45343;
    }
 </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="page-content-wrapper" class="">
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <?php if(Session::has('message')): ?>
                <p class="<?php echo e(Session::get('alert-class')); ?>"><?php echo e(Session::get('message')); ?></p>
            <?php endif; ?>    
            <div class="">
                <h1>Search for an Artist</h1>
                <p>Type an artist name and click on "Search". Then, click on any album from the results to play 30 seconds of its first track.</p>
                <form id="search-form">
                    <input type="text" id="query" value="" class="form-control" placeholder="Type an Artist Name"/>
                    <input type="submit" id="search" class="btn btn-primary" value="Search" />
                </form>
                <div id="results"></div>
            </div>
            <script id="results-template" type="text/x-handlebars-template">
                {{#each albums.items}}
                <div style="background-image:url({{images.0.url}})" data-album-id="{{id}}" class="cover"></div>
                {{/each}}
                <div class="row">
                    <ul class="pagination">
                        {{#if albums.next}}
                              <li><a href="#" onclick="getResult('{{albums.next}}')">Next Result</a></li>
                        {{/if}}
                        {{#if albums.previous}}
                              <li><a href="#" onclick="getResult('{{albums.previous}}')">Previous Result</a></li>
                        {{/if}}
                    </ul>                
                </div>
            </script> 
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#query" ).autocomplete({
      source: availableTags
    });

    /// find template and compile it
        templateSource = document.getElementById('results-template').innerHTML;
        template = Handlebars.compile(templateSource);
        resultsPlaceholder = document.getElementById('results');
        playingCssClass = 'playing';
        audioObject = null;
        /*console.log(templateSource);
        console.log(template);
*/
    var fetchTracks = function (albumId, callback) {
        $.ajax({
            url: 'https://api.spotify.com/v1/albums/' + albumId,
            success: function (response) {
                callback(response);
            }
        });
    };
    var getResult=function(queryurl){
        event.preventDefault();
        console.log(queryurl);
        $.ajax({
            url: queryurl,
            success: function (response) {
                console.log(response);
                resultsPlaceholder.innerHTML="";
                resultsPlaceholder.innerHTML = template(response);
            }
        });
    };

    var searchAlbums = function (query) {
        $.ajax({
            url: 'https://api.spotify.com/v1/search',
            data: {
                q: query,
                type: 'album'
            },
            success: function (response) {
                console.log(response);
                resultsPlaceholder.innerHTML = template(response);
            }
        });
    };

    results.addEventListener('click', function (e) {
        var target = e.target;
        if (target !== null && target.classList.contains('cover')) {
            if (target.classList.contains(playingCssClass)) {
                audioObject.pause();
            } else {
                if (audioObject) {
                    audioObject.pause();
                }
                fetchTracks(target.getAttribute('data-album-id'), function (data) {
                    audioObject = new Audio(data.tracks.items[0].preview_url);
                    audioObject.play();
                    target.classList.add(playingCssClass);
                    audioObject.addEventListener('ended', function () {
                        target.classList.remove(playingCssClass);
                    });
                    audioObject.addEventListener('pause', function () {
                        target.classList.remove(playingCssClass);
                    });
                });
            }
        }
    });

    document.getElementById('search-form').addEventListener('submit', function (e) {
        e.preventDefault();
        searchAlbums(document.getElementById('query').value);
    }, false);
    /*(function() {
        function login(callback) {
            var CLIENT_ID = '7cd48e041ecf48adabebf07eb6f03caa';
            var REDIRECT_URI = 'http://localhost/myspotify/spotify.php';
            function getLoginURL(scopes) {
                return 'https://accounts.spotify.com/authorize?client_id=' + CLIENT_ID +
                  '&redirect_uri=' + encodeURIComponent(REDIRECT_URI) +
                  '&scope=' + encodeURIComponent(scopes.join(' ')) +
                  '&response_type=token';
            }
            alert(CLIENT_ID);
            
            var url = getLoginURL([
                'user-read-email'
            ]);
            
            var width = 450,
                height = 730,
                left = (screen.width / 2) - (width / 2),
                top = (screen.height / 2) - (height / 2);
        
            window.addEventListener("message", function(event) {
                var hash = JSON.parse(event.data);
                if (hash.type == 'access_token') {
                    callback(hash.access_token);
                }
            }, false);
            
            var w = window.open(url,
                'Spotify',
                'menubar=no,location=no,resizable=no,scrollbars=no,status=no, width=' + width + ', height=' + height + ', top=' + top + ', left=' + left
               );
        }

        function getUserData(accessToken) {
            return $.ajax({
                url: 'https://api.spotify.com/v1/me',
                headers: {
                   'Authorization': 'Bearer ' + accessToken
                }
            });
        }

        var templateSource = document.getElementById('result-template').innerHTML,
            template = Handlebars.compile(templateSource),
            resultsPlaceholder = document.getElementById('result'),
            loginButton = document.getElementById('btn-login');
        
        loginButton.addEventListener('click', function() {
            login(function(accessToken) {
                getUserData(accessToken)
                    .then(function(response) {
                        loginButton.style.display = 'none';
                        alert(response);
                        resultsPlaceholder.innerHTML = template(response);
                    });
                });
        });
})();
*/    
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>