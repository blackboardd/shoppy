import { ProductProvider } from '@/features/product/services/productProvider';
import { ArrowCounterclockwise } from 'react-bootstrap-icons';

/**
 * Cancel button component.
 *
 * @returns {JSX.Element} The cancel button component.
 */
const RefreshButton = (): JSX.Element => {
  const handleRefresh = (): void => {
    refresh().then((): void => {
      window.location.href = '/';
    });
  };

  const refresh = async (): Promise<void> => {
    await ProductProvider.refreshProducts();
  };

  return (
    <button
      onClick={handleRefresh}
      type="button"
      className="btn btn-secondary product-form-button btn-icon"
    >
      <div className="icon icon-reset">
        {' '}
        <ArrowCounterclockwise />
      </div>
      <p style={{ marginBottom: 0 }}>Reset Database</p>
    </button>
  );
};

export default RefreshButton;
