<x-layout>
    <x-slot:title>
        {{ config('app.name') }}
    </x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="w-full h-auto p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
            <h3 class="text-xl font-semibold dark:text-gray-50">Tasks Summary</h3>
            <canvas id="taskSummaryChart" width="auto" height="auto"></canvas>
        </div>
        <div class="w-full grid grid-rows-3 gap-y-4">
            <a href="{{ route('tasks.index', ['status' => 'ongoing']) }}">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 items-center w-full rounded-lg p-4 h-full shadow bg-[#f39c12]">
                    <h3 class="text-xl font-semibold text-white">On Going Tasks</h3>
                    <span class="text-5xl mr-4 font-extrabold text-white text-left md:text-right">{{
                        $ongoingTasks}}</span>
                </div>
            </a>
            <a href="{{ route('tasks.index', ['status' => 'completed']) }}">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 items-center w-full rounded-lg p-4 h-full shadow bg-[#2ecc71]">
                    <h3 class="text-xl font-semibold text-white">Completed Tasks</h3>
                    <span class="text-5xl mr-4 font-extrabold text-white text-left md:text-right">{{
                        $completedTasks}}</span>
                </div>
            </a>
            <a href="{{ route('tasks.index', ['status' => 'overdue']) }}">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 items-center w-full rounded-lg p-4 h-full shadow bg-[#e74c3c]">
                    <h3 class="text-xl font-semibold text-white">Overdue Tasks</h3>
                    <span class="text-5xl mr-4 font-extrabold text-white text-left md:text-right">{{
                        $overdueTasks}}</span>
                </div>
            </a>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/chart.js">
    </script>

    <script>
        var ctx = document.getElementById('taskSummaryChart').getContext('2d');
        var taskSummaryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['On Going', 'Completed', 'Overdue'],
                datasets: [{
                    label: '',
                    data: [{{ $ongoingTasks }}, {{ $completedTasks }}, {{ $overdueTasks }}],
                    backgroundColor: ['#f39c12', '#2ecc71', '#e74c3c'],
                    borderColor: ['#e67e22', '#27ae60', '#c0392b'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>