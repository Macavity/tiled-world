import {Component} from 'angular2/core';

import {MapComponent} from "./modules/map/map.component";

@Component({
    selector: 'app',
    template: `
    <div class="row">
        <div class="col-md-2">
            <SidebarComponent></SidebarComponent>
        </div>
        <div class="col-md-10">
            <MapComponent></MapComponent>
            <ChatComponent></ChatComponent>
        </div>
    </div>
    `
})
export class AppComponent {
    
}