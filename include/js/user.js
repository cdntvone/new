$(document).ready(function() {
    function proof(movie) {
        $.getJSON('https://randomuser.me/api/', function(res) {
            var res = res.results[0]
            var name = res.name.last
            var avatar = res.picture.medium
            var country = res.location.country
        $(`<div class="proof text-white">
            <div class="ripple">
                <div class="proof-avatar"><img src="${avatar}"></div>
                    <div class="proof-data">
                    <h4>${name} from ${country}</h4>
                    <small>Watching ${movie}</small>
                    <p>Recently signed up</p>
                </div>
            </div>
           </div>`).appendTo('body')
        })
    }

    function shuffle(array) {
        var currentIndex = array.length,
            temporaryValue, randomIndex;
        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

    function rotate(i) {
        setTimeout(function() {
            $('.proof').remove();
            i++;
            if (i < 30) {
                var movie = shuffle(movies)
                rotate(i + 1)
                proof(movie[0])
            }
        }, 6000);
    }

    setTimeout(function() {
        rotate(1)
    }, 2000)

})
