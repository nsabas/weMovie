import { Controller } from "@hotwired/stimulus";
import axios from "axios";

export default class extends Controller {
    static targets = ['title', 'rate', 'userCount', 'iframeUrl']
    modal = null;

    closeModal(e) {
        this.iframeUrlTarget.setAttribute('src', '');
        this.iframeUrlTarget.innerHTML = '';
        this.element.style.display = 'none';
    }

    openModal(){
        this.element.style.display = 'block';
    }

    connect() {
        this.modal = this.element;
        this.element.style.display = 'none';
        this.element.addEventListener('openMyModal', (data) => {
            let movie = data.detail.movie;
            this.titleTargets.forEach((title) => {
                title.innerHTML = movie.title;
            })
            this.rateTarget.innerHTML = movie.rate;
            this.userCountTarget.innerHTML = movie.userCount;
            this.openModal();

            let path = this.element.getAttribute('data-video-uri').replace('__id__', movie.id);
            axios
                .get(path)
                .then((response) => {
                    this.iframeUrlTarget.setAttribute('src', response.data.link);
                })


        });
    }
}
