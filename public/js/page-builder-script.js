$(function () {
  // Initialize SummerNote
  $(".summerNote").summernote({
    height: 400,
  });
});

function getSlugFromString(str) {
  return str
    .toLowerCase()
    .replace(/[^a-z0-9-]/g, "-")
    .replace(/-+/g, "-")
    .replace(/^-|-$/g, "");
}

$("[name='title']").keyup(function () {
  $("[name='slug']").val(getSlugFromString(this.value));
});
