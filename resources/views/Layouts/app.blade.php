@yield('title', 'Respira y Sigue')
    @stack('styles')

💙 Respira y Sigue
[🏠 Inicio]({{ route('dashboard') }})

[🫁 Ejercicios]({{ route('ejercicios') }})

[📚 Recursos]({{ route('recursos') }})

[🔔 Recordatorios]({{ route('recordatorios') }})

[💙 Test emocional]({{ route('test-emocional') }})

[👤 Perfil]({{ route('perfil') }})

[🚪 Cerrar sesión]({{ route('home') }})


    @yield('content')

@stack('scripts')