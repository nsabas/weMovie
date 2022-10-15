import { Controller } from '@hotwired/stimulus';
import axios from "axios";

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        var timeout
        var that = this;

        this.element.addEventListener('input', function (e){
            e.preventDefault();
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function () {
                axios
                    .get(that.element.getAttribute('data-search-uri').replace('__keyword__', that.element.value))
                    .then((response) => {
                        let autocompleteList = response.data.results;
                        let containerListElement = document.createElement('ul');
                        containerListElement.classList.add('autocomplete-list')

                        containerListElement.addEventListener('mouseleave', (e) => {
                            containerListElement.style.display = 'none';
                        });

                        autocompleteList.forEach((result) => {
                           let elem = document.createElement('li');

                           elem.innerText = result.name;
                           containerListElement.appendChild(elem);
                        });
                        that.element.parentNode.appendChild(containerListElement);
                    });

            }, 1000);

        })
    }
}
