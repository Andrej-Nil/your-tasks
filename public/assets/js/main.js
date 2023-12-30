'use strict'

class Service {
    constructor() {
        this.POST = 'POST';
        this.GET = 'GET';
        this.PUT = 'PUT';
        this.PATCH = 'PATCH'
        this.DELETE = 'DELETE';
        this.DELETE = 'DELETE';
    }

    patch = async (api, data) => {
        const body = {
            ...data,
            _method: this.PATCH,
        }
        const response = await this.getData(api, this.POST, body);

        if (response.ok) {
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

class Log {
    error = (message = 'Произошла ошибка') => {
        console.error(message);
    }
}

// this.declForTotalFindedItem = ['', 'а', 'ов'];
class Render {
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

    render = ($parent, getHtmlMarkup, argument = false, array = false, where = 'beforeend') => {
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

        if (!array && !argument) {
            markupAsStr = getHtmlMarkup();
        }
        $parent.insertAdjacentHTML(where, markupAsStr);
    }
}

class Spinner extends Render {


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

class TaskController {
    constructor() {
        this.init();
    }

    init = () => {
        this.model = new TaskModel();
        this.view = new TaskView();
        this.listeners();
    }

    changeStatusHandler = async ($btn) => {
        const $task = $btn.closest('[data-task]');
        this.view.showSpinner($task);
        const action = $btn.dataset.action;
        const id = this.getId($task);
        // if(!$task) {
        //   log.error(`Error: $task typeof ${typeof $task}. $task must be DOM Element`);
        //   return;
        // }


        const res = await this.model.changeStatus({id, action});

        if (res.success) {
            this.view.hideSpinner($task);
            this.success($task, res);
        } else if (res.error) {
            this.view.hideSpinner($task);
            this.fail($task, res)
        }
    }

    // complete = ($btn) => {
    //
    // }

    getId = ($task) => {
        return $task.dataset.task;
    }

    success = ($task, res) => {
        if(res.data.status === 'completed'){
            this.view.completeHandler($task, res.data);
        }else{
            this.view.progressHandler($task, res.data);
        }

    }

    fail = ($task, res) => {
        console.log(res);
    }

    clickHandler = async (e) => {
        if (e.target.closest("[data-action]")) {
            await this.changeStatusHandler(e.target.closest("[data-action]"));
        }

    }

    listeners = () => {
        document.addEventListener('click', this.clickHandler);
    }
}

class TaskModel extends Service {
    constructor() {
        super();
        this.base = '/api/tasks/'
        this.progress = this.base + 'progress';
        this.complete = this.base + 'complete';
        this.cancel = this.base + 'cancel';

    }

    changeStatus = async (data) => {
        const api = this.base + data.action;
        return await this.patch(api, {id: data.id});
    }
}

class TaskView extends Render {
    constructor() {
        super();
        this.init();
    }

    init = () => {
        this.spinner = new Spinner();
        this.PAUSE = 'pause';
        this.PROGRESS = 'progress';
        this.COMPLETED = 'completed';
        this.OVERDUE = 'overdue';
    }

    showSpinner = ($task) => {
        this.spinner.create($task);
    }

    hideSpinner = ($task) => {
        this.spinner.destroy($task);
    }

    changeTextStatus = ($task, statusText) => {
        const $statusText = $task.querySelector('[data-status-text]');
        $statusText.innerHTML = statusText;
    }

    changeBtnProgress = ($task, icon) => {
        const $iconBtn = $task.querySelector('[data-icon-progress ]');
        $iconBtn.src = icon;
    }

    deleteActionBtn = ($task) => {
        const $buttons = $task.querySelectorAll('[data-action]');

        $buttons.forEach(($item) => {
            this.delete($item);
        })


    }

    overdueStatusView = ($task) => {
        $task.classList.remove(this.PAUSE);
        $task.classList.remove(this.PROGRESS);
        $task.classList.add(this.OVERDUE);
    }

    progressStatusView = ($task) => {
        $task.classList.remove(this.PAUSE);
        $task.classList.add(this.PROGRESS);

    }

    pauseStatusView = ($task) => {
        $task.classList.remove(this.PROGRESS);
        $task.classList.add(this.PAUSE);
    }
    completedStatusView = ($task) => {
        $task.classList.remove(this.PROGRESS);
        $task.classList.remove(this.PAUSE);
        $task.classList.remove(this.OVERDUE);
        $task.classList.add(this.COMPLETED);
    }

    changeStatusView = ($task, data) => {
        if (data.isOverdue) {
            this.overdueStatusView($task);
        } else if (data.status === this.PROGRESS) {

            this.progressStatusView($task);
        } else if (data.status === this.PAUSE) {
            this.pauseStatusView($task);
        } else if (data.status === this.COMPLETED){
            this.completedStatusView($task)
        }
    }

    progressHandler = ($task, data) => {
        this.changeTextStatus($task, data.statusText);
        this.changeBtnProgress($task, data.icon);
        this.changeStatusView($task, data)
    }

    completeHandler = ($task, data) => {
        this.changeTextStatus($task, data.statusText);
        this.changeStatusView($task, data)
        this.deleteActionBtn($task)
    }

}


// const log = new Log();
// const spinner = new Spinner();
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









