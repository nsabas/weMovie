import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.element.addEventListener('change', function (e) {
            e.preventDefault();
            console.log('value changed !');
            console.log(document.getElementsByTagName(this.element.getName()));
        })
    }
}
