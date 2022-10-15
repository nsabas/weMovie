import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ['title', 'userCount'];

    dispatchOpenModal(){
        document.getElementById('myModal').dispatchEvent(
            new CustomEvent(
                'openMyModal',
                {
                    detail:
                        {
                            movie : {
                                id: this.element.getAttribute('data-movie-id'),
                                title: this.titleTarget.innerHTML,
                                rate: 0,
                                userCount: this.userCountTarget.innerHTML,
                            }
                        }
                }
            )
        );
    }
}
