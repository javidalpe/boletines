import 'react-app-polyfill/ie9';
import ReactDOM from 'react-dom';
import React, { lazy, Suspense } from 'react';

const Bar = lazy(() => import('./Bar'));

const Main = () => (
    <Suspense fallback={'Cargando buscador...'}>
      <Bar />
    </Suspense>
)



ReactDOM.render(<Main/>, document.getElementById('root'));

