@csrf
<div class="form-group">
    <label>Goal</label>
    <input type="text" name="goal" class="form-control" value="{{ old('goal', $mission->goal ?? '') }}">
</div>
<div class="form-group">
    <label>Mission Date</label>
    <input type="date" name="mission_date" class="form-control"
        value="{{ old('mission_date', $mission->mission_date ?? '') }}">
</div>
<div class="form-group">
    <label>CEO Signature Date</label>
    <input type="date" name="ceo_signature_date" class="form-control"
        value="{{ old('ceo_signature_date', $mission->ceo_signature_date ?? '') }}">
</div>
<div class="form-group">
    <label>People</label>
    @foreach($people as $person)
        <div>
            <input type="checkbox" name="person_ids[]" value="{{ $person->id }}" {{ isset($mission) && $mission->people->contains($person->id) ? 'checked' : '' }}>
            {{ $person->name }} ({{ $person->department->name }})
        </div>
    @endforeach
</div>
<button type="submit" class="btn btn-success">Save</button>
