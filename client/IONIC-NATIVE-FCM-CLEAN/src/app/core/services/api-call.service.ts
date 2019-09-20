import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpHeaders} from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})

export class ApiCallService {

  url : string;
  token: string;
  loading = false;
  errorMessage = '';

  constructor(private http: HttpClient)
  {

  }
  sendToken(url: string, token: string)
  {
    let postData = {
      "token": token,
    }
    return this.http.post(url, postData)
      .subscribe(data =>
      {
        console.log(data);
      }, error => {
        console.log(error);
      });
  }
}