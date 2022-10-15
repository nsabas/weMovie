import {Controller} from "@hotwired/stimulus";
import axios from "axios";

export default class extends Controller {
    connect() {
        axios
            .get(this.element.getAttribute('data-video-uri'))
            .then((response) => {
                console.log(response);
                this.element.setAttribute('src', response.data.link);
            })
    }
}
