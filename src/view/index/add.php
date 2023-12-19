<section class="section" id="form">
  <form action="/add" method="post" enctype="multipart/form-data" class="form">
    <div class="form-row">
      <label class="label" for="title">Title</label>
      <input class="input" id="title" name="title" type="text" required>
    </div>
    <div class="form-row">
      <label class="label" for="author">Author</label>
      <input class="input" id="author" name="author" type="text" required>
    </div>
    <div class="form-row">
      <label class="label" for="pub">Publisher</label>
      <input class="input" id="pub" name="pub" type="text" required>
    </div>
    <div class="form-row">
      <label class="label" for="genre">Genre</label>
      <select class="input" id="genre" name="genre[]" multiple>
        <option value="romance">Romance</option>
        <option value="slice-of-life">Slice Of Life</option>
        <option value="mystery">Mystery</option>
        <option value="horror">Horror</option>
      </select>
    </div>
    <div class="form-row">
      <label class="label" for="lang">Language</label>
      <select class="input" id="lang" name="lang[]" multiple>
        <option value="japanese">Japanese</option>
        <option value="english">English</option>
        <option value="spanish">Spanish</option>
      </select>
    </div>
    <div class="form-row">
      <label class="label" for="date">Date</label>
      <input class="input" name="date" type="date" id="date" required>
    </div>
    <div class="form-row">
      <label class="label" for="desc">Description</label>
      <textarea class="input input--date" id="desc" name="desc" required></textarea>
    </div>
    <div class="form-row">
        <label class="label" for="mark">Watermark</label>
        <input class="input" id="mark" name="mark" type="text" required>
    </div>
    <div class="form-row">
      <label class="label" for="cover">Cover</label>
      <input class="input" id="name" name="cover" type="file" required>
    </div>
    <div class='form-row'>
      <div class="label"></div>
      <div class="input">
        <input class="input input--button button--reset" type="reset" value="Reset">
        <button class="input input--button">Submit</button>
      </div>
    </div>
  </form>
</section>
