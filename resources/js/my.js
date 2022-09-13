dateFormat = {
  _fmt: {
    "yyyy": function (date) { return date.getFullYear() + ''; },
    "MM": function (date) { return ('0' + (date.getMonth() + 1)).slice(-2); },
    "dd": function (date) { return ('0' + date.getDate()).slice(-2); },
    "hh": function (date) { return ('0' + date.getHours()).slice(-2); },
    "mm": function (date) { return ('0' + date.getMinutes()).slice(-2); },
    "ss": function (date) { return ('0' + date.getSeconds()).slice(-2); }
  },
  _priority: ["yyyy", "MM", "dd", "hh", "mm", "ss"],
  format: function (date, format) {
    return this._priority.reduce((res, fmt) => res.replace(fmt, this._fmt[fmt](date)), format)
  }
};

preview = {
  update: function () {
    var date = new Date(document.getElementById("pubDate").value);
    var published_at = dateFormat.format(date, 'yyyy年MM月dd日');
    // var published_at = moment(document.getElementById("pubDate").value).format("YYYY年MM月DD日");
    // document.getElementById("preview_list_title").innerText = document.getElementById("list_title").value + " " + published_at;
    // document.getElementById("preview_post_title").innerText = document.getElementById("post_title").value;
    document.getElementById("preview_list_title").innerText = document.getElementById("title").value + " " + published_at;
    document.getElementById("preview_post_title").innerText = document.getElementById("title").value;
    document.getElementById("preview_post_content").innerText = document.getElementById("post_content").value;
  }
};



// 確認ダイアログを出す
$('.confirm').on('click', function (e) {
  return !!confirm($(this).data('confirm'));
});
