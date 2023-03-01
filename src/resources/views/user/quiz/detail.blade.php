<pre>
  <?php
  // var_dump($Questions);
  ?>
</pre>

@section('title', 'Detail')
@section('content')
  <div class="main_container">
    <h1 class="question_title">{{ $big_question->name }}</h1>     
    <div class="main_inner" id="quizDivWrapper">
      @foreach($questions as $question)
      <div class="quiz_div"> 
        <h2 class="question">{{$loop->iteration}}.この地名はなんて読む？</h2>
        <!-- https://qiita.com/engineer_atsumi/items/8057b35a28063f03450e  -->
        <div class="question-image-container">
            <img src="{{ asset('images/' . $question->image) }}" alt="" class="question_image">`
        </div> 
        <ul class="option_list" id="optionList${i + 1}">
          @foreach($question->choices as $choice)
          <!-- ↑これ、１階層上のforeachの中だから、$Questions->questions as $questionの$questionの中のchoicesってやつを回すってことになる。それを踏まえて書く。このつながり方というか繋げ方というかリレーションをどうやってやってるか明確にしておくべきである。 -->
          <li>{{ $choice->name }}</li>
          @endforeach
        </ul>
      </div>
      @endforeach
      
      
    </div>
    </div>
  </div>
@section('script')
<script src="{{ asset('/js/kuizy.js') }}"></script>
@endsection

