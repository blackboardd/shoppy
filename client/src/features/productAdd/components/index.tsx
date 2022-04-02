import ProductAddForm from '@/features/productAddForm/components';
import './styles.scss';

/**
 * Product add page component.
 * 
 * @returns {JSX.Element}
 */
const ProductAdd = (): JSX.Element => {
  return (
    <div className="product-add-container">
      <ProductAddForm />
    </div>
  );
};

export default ProductAdd;
