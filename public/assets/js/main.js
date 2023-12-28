'use strict'

class Service{
  constructor() {
    this.POST = 'POST';
    this.GET = 'GET';
    this.PUT = 'PUT';
    this.PATCH = 'PATCH'
    this.DELETE = 'DELETE';
    this.DELETE = 'DELETE';
  }



  patch = async (api, data) =>{
    const body = {
      ...data,
      _method: this.PATCH,
    }
    const response = await this.getData(api, this.POST, body);

    if(response.ok) {
      return await response.json()
    } else {
      return {error: 'Что то пошло не так! Поробуйте позже.'};
    }
  }

  getData = (api, method, body) => {

    return fetch(api, {
      method: method,
      body: new URLSearchParams(body)
    })
  }


}
// this.declForTotalFindedItem = ['', 'а', 'ов'];
class Render{
  delete = ($element) => {
    if (!$element) {
      return;
    }
    $element.remove();
  }

  clear = ($element) => {
    if (!$element) {
      return;
    }
    $element.innerHTML = '';
  }

  render = ($parent, getHtmlMarkup, argument = false, array = false,  where = 'beforeend' ) => {
    let markupAsStr = '';
    if (!$parent) {
      return;
    }

    if (array) {
      array.forEach((item) => {
        markupAsStr = markupAsStr + getHtmlMarkup(item);
      })
    }
    if (argument) {
      markupAsStr = getHtmlMarkup(argument);
    }

    if(!array && !argument){
      markupAsStr = getHtmlMarkup();
    }
    $parent.insertAdjacentHTML(where, markupAsStr);
  }
}

class Spinner extends Render{


  create = ($parent) => {
    this.render($parent, this.html);
  }

  destroy = ($parent) => {
    const $spinner = $parent.querySelector('[data-spinner]');
    this.delete($spinner);
  }
  html = (message = 'Идет обработка запроса!') => {
    return `
      <div data-spinner class="spinner">
        <p class="spinner__message">${message}</p>
      </div>
    `
  }
}




class TaskController{
  constructor() {
    this.init();
  }

  init = () => {
    this.model = new TaskModel();
    // this.view = new TaskView();
    this.listeners();


  }

  changeProgressHandler = async ($btn) => {
    const $task = $btn.closest('[data-task]');
    spinner.create($task);
    const id = this.getId($task);
    const res = await this.model.changeProgress(id);
    if(res.success){
      spinner.destroy($task);

      this.changeProgress($task, res.data);
    } else if(res.error){
      console.log(res);
    }
  }

  changeProgress = ($task, data) => {
    this.changeBtnProgress($task, data)
    if(data.isOverdue){
      $task.classList.remove('pause');
      $task.classList.remove('progress');
      $task.classList.add(data.isOverdue);
      return;
    }

    if(data.status === 'progress') {
      $task.classList.remove('pause');
      $task.classList.add('progress');
      return;
    }

    if(data.status === 'pause'){
      $task.classList.remove('progress');
      $task.classList.add('pause');
      return;
    }


    // console.log(data);

  }

  changeBtnProgress = ($task, data) => {
    const $statusText = $task.querySelector('[data-status-text]');
    const $iconBtn = $task.querySelector('[data-icon-progress ]');
    $statusText.innerHTML = data.statusText;
    $iconBtn.src = data.icon;
  }


  complete = ($btn) => {

  }

  getId = ($task) => {
    return $task.dataset.task;
 }



  clickHandler = async (e) => {
      if(e.target.closest("[data-action='progress']")){
          await this.changeProgressHandler(e.target.closest("[data-action='progress']"));
          return;
      }
      if(e.target.closest("[data-action='complete']")){
        this.complete(e.target.closest("[data-action='complete']"));
      }
  }



  listeners = () => {
    document.addEventListener('click', this.clickHandler);
  }
}

class TaskModel extends Service{
  constructor() {
    super();
    this.apiProgress = '/api/tasks/progress';
    this.apiComplete = '/api/tasks/complete';
    this.apiCancel = '/api/tasks/cancel';

  }

  changeProgress = async (id) => {
     return await this.patch(this.apiProgress, {id});
  }
}

const spinner = new Spinner();
const task = new TaskController();



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









