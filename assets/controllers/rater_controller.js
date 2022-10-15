import { Controller } from "@hotwired/stimulus";
let rater = require("rater-js");

export default class extends Controller {
    connect() {
        let that = this.element;
        let avgRating = that.getAttribute('data-avg-rate');

        let myRater = rater({
            element: that,
            readOnly: true,
            max: 5,
            rating: parseFloat(avgRating) / 2
        });



    }
}
