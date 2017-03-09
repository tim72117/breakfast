import { Component, OnInit } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/add/operator/toPromise';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css']
})
export class OrdersComponent implements OnInit {

  orders = [];

  constructor(private http: Http) {
  }

  ngOnInit() {
    this.http.get('api/orders?api_token=1').toPromise().then(response => { this.orders = response.json().orders;console.log(this.orders); })
    console.log(1);
  }

}
