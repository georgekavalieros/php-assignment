            var comments = document.getElementsByClassName('comment');
            for (var i = 0; i < comments.length; i++) {
                document.getElementById('comment-container').appendChild(comments[i]);
            }
            
            var clicks0 = 0;
            document.getElementById('changeContr0').addEventListener("click", function(){
                if(clicks0%2 == 0)
                    document.getElementById('image').style.opacity = "0.4";
                else
                    document.getElementById('image').style.opacity = "1";
                clicks0++;
            });
            
            var clicks1 = 0;
            document.getElementById('changeContr1').addEventListener("click", function(){
                if(clicks1%2 == 0)
                    document.getElementById('image').style.filter= "grayscale(150%)";
                else
                    document.getElementById('image').style.filter= "grayscale(0%)";
                clicks1++;
            });
            
            var clicks2 = 0;
            document.getElementById('changeContr2').addEventListener("click", function(){
                if(clicks2%2 == 0)
                    document.getElementById('image').style.filter="brightness(150%)";
                else
                    document.getElementById('image').style.filter="brightness(100%)";
                clicks2++;
            });
            
            var clicks3 = 0;
            document.getElementById('changeContr3').addEventListener("click", function(){
                if(clicks3%2 == 0)
                    document.getElementById('image').style.filter= "contrast(200%)";
                else
                    document.getElementById('image').style.filter= "contrast(100%)";
                clicks3++;
            });
            
            var clicks4 = 0;
            document.getElementById('changeContr4').addEventListener("click", function(){
                if(clicks4%2 == 0)
                    document.getElementById('image').style.filter= "saturate(7)";
                else
                    document.getElementById('image').style.filter= "saturate(1)";
                clicks4++;
            });