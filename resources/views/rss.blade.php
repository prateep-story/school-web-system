<rss version="2.0">
  <channel>
    <title>ข่าวประชาสัมพันธ์</title>
    <description>โรงเรียนปางศิลาทองศึกษา</description>
    <link>https://www.pslt.ac.th</link>
    <copyright>© สงวนลิขสิทธิ์ 2562 โรงเรียนปางศิลาทองศึกษา</copyright>
    <language>th-TH</language>
    @foreach ($articles as $article)
    <item>
      <title>{{$article->article}}</title>
      <link>{{ url('อ่าน/'.$article->category.'/'.$article->slug)}}</link>
      <enclosure url="{{ url('images/thumbnails/'.$article->image)}}" />
      <pubDate>{{$article->created_at->format('D, d M Y H:i:s O')}}</pubDate>
    </item>
    @endforeach
  </channel>
</rss>