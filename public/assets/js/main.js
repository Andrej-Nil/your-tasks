// const params = new URLSearchParams('id=' + '1' + '&_method=' + 'delete');
// fetch('/tasks', {
//     method: 'POST',
//     headers: {
//       "Content-type": "application/x-www-form-urlencoded"
//     },
//     body:  params
//   }).then(data => data.json()).then(body => console.log(body));
// const form = new FormData();
// form.append('id', '1');
// form.append('_method', 'delete');
//
// async function test(){
//   let response = await fetch('/tasks', {
//     method: 'POST',
//     headers: {
//       //       "Content-Type": "application/json",
//       // "Accept": "application/json",
//     },
//     body: form
//   });
//
//   const res = await response.json();
//   console.log(res)
//
// }
//
// test();

// async function request(url, body = {}, method = 'POST') {
//   // body._token = _token;
//
//   if(!(body instanceof FormData)) {
//     body = JSON.stringify(body);
//   }
//   let data = {
//     method,
//     body
//   }
//   if(body instanceof FormData) {
//     data.headers = {
//       // "X-CSRF-Token": _token,
//     };
//   } else {
//     data.headers = {
//       "Content-Type": "application/json",
//       "Accept": "application/json",
//       // "X-Requested-With": "XMLHttpRequest",
//       // "X-CSRF-Token": _token,
//     };
//   }
//   let response = {rez:0, message: 'Произошла ошибка, попробуйте позже'};
//   try {
//     const changeLang = await fetch(url, data);
//     if (changeLang.ok) {
//       response = await changeLang.json();
//     } else {
//       AlertN(response.message);
//     }
//   } catch (e) {
//     console.log(e);
//   }
//   console.log(response)
//   return response;
// }
//
//
// request('/tasks', {
//   id: 1
// });



