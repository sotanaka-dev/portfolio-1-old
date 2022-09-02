/* ヘッダー */
const header = document.getElementById('header')
const header_height = header.offsetHeight
let scroll_point = 0
let last_point = 0

window.addEventListener("scroll", event => {
    scroll_point = window.scrollY

    if (scroll_point > last_point && scroll_point > header_height) {
        header.classList.add('header--hide')
    } else {
        header.classList.remove('header--hide')
    }
    last_point = scroll_point
})

/* フラッシュメッセージ */
window.addEventListener('show_flash_message', event => {
    const alert = document.getElementById('alert')
    alert.classList.add('alert--show')

    setTimeout(() => {
        alert.classList.remove('alert--show')
    }, 3000)
})


/* 商品ページ */
window.addEventListener('page_switching', event => {
    window.scrollTo(0, 0)
})

window.addEventListener('sort_by', event => {
    document.getElementById('sort_sidebar_check').checked = false
})

/* バリデーション前 */
window.addEventListener('before_validation', event => {
    window.scrollTo(0, 0)
})

/* パスワードマスク */
function passwordMaskSwitch(text_box_id, eye_icon_id) {
    const text_box = document.getElementById(text_box_id)
    const eye_icon = document.getElementById(eye_icon_id)
    if (text_box.type === 'text') {
        text_box.type = 'password'
        eye_icon.className = 'fa-solid fa-eye'
    } else {
        text_box.type = 'text'
        eye_icon.className = 'fa-solid fa-eye-slash'
    }
}

/* 確認ダイアログ */
function confirmation(message) {
    return confirm(message)
}


/* お気に入り */
function stylingFavIcon(id, fav_add, fav_rm) {
    document.getElementById('fav_add').id = fav_add
    document.getElementById('fav_rm').id = fav_rm

    let fav_list = JSON.parse(localStorage.getItem('fav_list'))

    if (fav_list && fav_list.find(f => f.id === id)) {
        document.getElementById(fav_rm).classList.remove("fav__hide")
    } else {
        document.getElementById(fav_add).classList.remove("fav__hide")
    }
}

/* NOTE: 商品のページ切り替え・検索・並べ替え、お気に入り追加・削除の際の共通処理 */
window.addEventListener('after_async_process', event => {
    let id = event.detail.id
    let fav_add = 'fav_add_' + id
    let fav_rm = 'fav_rm_' + id

    /* NOTE: 非同期の商品の検索・並べ替え後のページに直前ページと同一商品がある場合、
    favは再レンダリングされないので重複を防ぐためidをリセット */
    let fav_add_old = document.getElementById(fav_add)
    let fav_rm_old = document.getElementById(fav_rm)
    if (fav_add_old && fav_rm_old) {
        fav_add_old.id = 'fav_add'
        fav_rm_old.id = 'fav_rm'
    }

    stylingFavIcon(id, fav_add, fav_rm)
})

/* NOTE: お気に入り商品をローカルストレージへ追加 */
window.addEventListener('add_to_fav', event => {
    let fav_list = JSON.parse(localStorage.getItem('fav_list'))

    if (!fav_list) fav_list = []

    let fav = {
        'id': event.detail.id,
        'name': event.detail.name,
        'price': event.detail.price,
        'path': event.detail.path,
    }

    fav_list.push(fav)

    localStorage.setItem('fav_list', JSON.stringify(fav_list))
})

/* NOTE: 対象のお気に入り商品をフィルタリングしてローカルストレージから削除 */
window.addEventListener('rm_from_fav', event => {
    let fav_list = JSON.parse(localStorage.getItem('fav_list'))

    fav_list = fav_list.filter((fav) => {
        if (fav.id !== event.detail.id) {
            return fav
        }
    })

    localStorage.setItem('fav_list', JSON.stringify(fav_list))
})

window.addEventListener('after_rm_from_fav', event => {
    document.getElementById(event.detail.id).remove()

    const fav_list_ul = document.getElementById('fav_list_ul')
    if (!fav_list_ul.childElementCount) {
        insertFavEmptyMessage()
    }
})

function insertFavEmptyMessage() {
    document.getElementById('fav_list_heading').classList.add('fav-list--hide')
    document.getElementById('fav_list_ul').classList.add('fav-list--hide')
    document.getElementById('fav_list_empty').classList.add('fav-list--show')
    document.getElementById('fav_list_empty').classList.add('fav-list--show')
    document.getElementById('fav_list_btn').classList.add('fav-list--show')
}




/* 商品詳細 */

window.addEventListener('select_thumbnail', event => {
    document.getElementsByClassName('detail__thumbnail')[event.detail.id]
        .classList.add('detail__thumbnail--select')
})
