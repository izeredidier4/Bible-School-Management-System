@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Report Details</div>
                <div class="card-body">
                    <h4>Child Information</h4>
                    <p><strong>Name:</strong> {{ $report->child->name }}</p>
                    <p><strong>Age:</strong> {{ $report->age }}</p>
                    <p><strong>Class:</strong> {{ $report->child->class->name }}</p>

                    <h4>Course Information</h4>
                    <p><strong>Course:</strong> {{ $report->course->title }}</p>
                    <p><strong>Grade:</strong> {{ $report->grade }}</p>

                    <h4>Teacher's Remarks</h4>
                    <p>{{ $report->teachers_remarks ?: 'No remarks provided.' }}</p>

                    <!-- Add other report-related details here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
