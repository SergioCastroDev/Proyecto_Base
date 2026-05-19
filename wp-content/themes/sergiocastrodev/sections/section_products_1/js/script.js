document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementsByClassName('products_1_card').length === 0) return;
    add_events_false_link_products1();
});

function add_events_false_link_products1() {
    var cards = document.getElementsByClassName('products_1_card');
    for (var i = 0; i < cards.length; i++) {
        cards[i].onclick = function (e) {
            if (e.target.closest('a')) return;
            var link = this.querySelector('h3 a');
            if (link) link.click();
        };
    }
}
