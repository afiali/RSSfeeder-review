 </div>
 
            </div>

        </div>

    </div>

    <div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2016</p>
                </div>
            </div>
        </footer>

    </div>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script>
        function commentSubmit(){
          var comment = document.getElementById('comment').value;
          var article_id = document.getElementById('comment').name;
          var UrlToSend = "comment_submit.php?comment="+comment+"&article_id="+article_id;

          window.location = UrlToSend;
        }

        function vote_up(article){
          var score = document.getElementById('vote_up').value;
          var UrlToSend = "voting_submit.php?article_id="+article+"&score="+score;

          window.location = UrlToSend;
        }

        function vote_down(article){
          var score = document.getElementById('vote_down').value;
          var UrlToSend = "voting_submit.php?article_id="+article+"&score="+score;

          window.location = UrlToSend;
        }
    </script>
</body>

</html>
