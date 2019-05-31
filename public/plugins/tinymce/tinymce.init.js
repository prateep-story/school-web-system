tinymce.init({
    selector: 'textarea',
    theme: 'modern',
    skin: 'lightgray',
    height: 300,
    menubar: true,
    plugins: [
        'table advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
        ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist table outdent indent | removeformat | code help',
    image_advtab: true,
    image_class_list: [{
        title: 'Responsive ',
        value: 'img-fluid'
      },
      {
        title: 'Thumbnail ',
        value: 'img-fluid img-thumbnail'
      },
      {
        title: 'Rounded ',
        value: 'img-fluid rounded'
      },
      {
        title: 'Circle ',
        value: 'img-fluid rounded-circle'
      },
    ],
    table_class_list: [{
        title: 'Table',
        value: 'table'
      },
      {
        title: 'Table Striped',
        value: 'table table-striped'
      },
      {
        title: 'Table Dark',
        value: 'table table-dark'
      },
      {
        title: 'Table Bordered',
        value: 'table table-bordered'
      },
      {
        title: 'Table Borderless',
        value: 'table table-borderless'
      },
      {
        title: 'Table Hover',
        value: 'table table-hover'
      },
    ],
    relative_urls: false,
    external_filemanager_path: "/plugins/tinymce/filemanager/",
    filemanager_title: "Filemanager",
    filemanager_access_key: "myPrivateKey",
    external_plugins: {
      "filemanager": "/plugins/tinymce/filemanager/plugin.min.js"
    }
  });